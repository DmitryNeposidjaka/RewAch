<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reward
 *
 * @package App\Models
 * @property Approve[]
 * @method static Builder approved()
 * @method static Builder notApproved()
 * @property int $id
 * @property int $user_id
 * @property int $achievement_id
 * @property int $approved
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Achievement $achievement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Approve[] $approves
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereAchievementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reward whereUserId($value)
 * @mixin \Eloquent
 */
class Reward extends Model implements HasApprovedContract
{
    use HasApprovedTrait;

    protected $fillable = [
        'user_id',
        'achievement_id',
        'approved'
    ];

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
