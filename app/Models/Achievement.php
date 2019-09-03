<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
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
 * @method Builder approved()
 * @method Builder notApproved()
 */
class Achievement extends Model implements HasApprovedContract
{
    use SoftDeletes, HasApprovedTrait;

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
     * @param Builder $query
     * @return Builder
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where($this->getTable() . '.approved', true);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotApproved(Builder $query)
    {
        return $query->where('approved', false);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}