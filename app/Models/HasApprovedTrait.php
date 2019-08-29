<?php

namespace App\Models;


/**
 * Trait HasApprovedTrait
 * @package App\Models
 */
trait HasApprovedTrait
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param  string $related
     * @param  string $name
     * @param  string $type
     * @param  string $id
     * @param  string $localKey
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * Save the model to the database.
     *
     * @param  array $options
     * @return bool
     */
    abstract function save(array $options = []);

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function approves(): \Illuminate\Database\Eloquent\Relations\MorphMany
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

    /** Approve current achievement
     * @return bool
     */
    public function approve(): bool
    {
        $this->approved = true;
        return $this->save();
    }

    /** Remove approving from current achievement
     * @return bool
     */
    public function disApprove(): bool
    {
        $this->approved = false;
        return $this->save();
    }
}