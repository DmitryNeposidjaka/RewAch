<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

interface HasApprovedContract
{
    public function isApprovedBy(User $user): bool;

    public function getApproveByUser(User $user);

    public function approve(): bool;

    public function disApprove(): bool;

    public function approves(): MorphMany;

    public function scopeApproved(Builder $query): Builder;
}