<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class Achievement
 * @package App\Models
 * @property $parent App\Models\Achievement|null
 * @property $children App\Models\Achievement|null
 * @property $thumbnail_path string
 * @property $approves App\Models\Approve|null
 * @property $author App\Models\User
 */
class Achievement extends Model implements HasApproved
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'parent', 'author'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
        'progressive' => 'boolean',
    ];

    /**
     * @return string
     */
    public function getThumbnailPathAttribute()
    {
        return Storage::disk('public')->exists($this->attributes['thumbnail']) ?
            Storage::disk('public')->url($this->attributes['thumbnail']) :
            '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Achievement::class, 'id', 'parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authoredBy()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function children()
    {
        return $this->belongsTo(Achievement::class, 'id', 'parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function approves()
    {
        return $this->morphMany(Approve::class, 'entity');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isApprovedBy(User $user): bool
    {
        return $this->approves()->where('user_id', $user->id)->exists();
    }

    /**
     * @param User $user
     * @return Approve|\Illuminate\Database\Eloquent\Relations\MorphMany|null|object
     */
    public function getApproveByUser(User $user)
    {
        return $this->approves()->where('user_id', $user->id)->first();
    }


}