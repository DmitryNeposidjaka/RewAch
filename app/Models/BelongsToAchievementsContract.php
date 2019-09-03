<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface BelongsToAchievementsContract
{
    /**
     * @return BelongsToMany
     */
    public function achievements(): BelongsToMany;
}