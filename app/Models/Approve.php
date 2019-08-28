<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Approve
 *
 * @package App\Models
 * @property $entity App\Models\Achievement|null
 * @property int $user_id
 * @property string $entity_type
 * @property int $entity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Approve onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Approve whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Approve withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Approve withoutTrashed()
 * @mixin \Eloquent
 */
class Approve extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surety()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
