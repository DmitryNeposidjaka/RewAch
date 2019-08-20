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
 */
class Achievement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'parent'
    ];

    protected $casts = [
        'active' => 'boolean',
        'progressive' => 'boolean',
    ];


    public function getThumbnailPath()
    {
        return Storage::disk('public')->exists($this->attributes['thumbnail'])? Storage::disk('public')->get($this->attributes['thumbnail']) : '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Achievement::class, 'id', 'parent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function children()
    {
        return $this->hasOne(Achievement::class, 'id', 'parent');
    }
}