<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reward
 * @package App\Models
 * @property Approve[] $approves
 */
class Reward extends Model implements HasApproved
{
    use HasApprovedTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeApproved(Builder $query)
    {
        return $query->where($this->getTable().'.approved', true);
    }

}
