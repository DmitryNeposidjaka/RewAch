<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reward
 * @package App\Models
 * @property Approve[]
 * @method static Builder approved()
 * @method static Builder notApproved()
 */
class Reward extends Model implements HasApproved
{
    use HasApprovedTrait;

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

}
