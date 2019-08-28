<?php

namespace App\Models;


interface HasApproved
{
    public function isApprovedBy(User $user): bool;

    public function getApproveByUser(User $user);

    public function approve(): bool;

    public function disApprove(): bool;

    public function approves(): \Illuminate\Database\Eloquent\Relations\MorphMany;
}