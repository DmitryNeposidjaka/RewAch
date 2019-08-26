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
 */
class Achievement extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'parent'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
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
}