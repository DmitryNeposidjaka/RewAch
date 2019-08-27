<?php

namespace App\Models;


interface HasApproved
{
    public function isApprovedBy(User $user): bool;

    public function getApproveByUser(User $user);
}