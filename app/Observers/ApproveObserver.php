<?php

namespace App\Observers;

use App\Models\Achievement;
use App\Models\Approve;

class ApproveObserver
{
    /**
     * Handle the approve "created" event.
     *
     * @param  \App\Models\Approve  $approve
     * @return void
     */
    public function created(Approve $approve)
    {
        $entity = $approve->entity;
        if($entity && $approve->entity_type == Approve::class) {
            /**
             * @var $entity Achievement
             */
            if(count($entity->approves) == 2) {
                $entity->update(['active' => true]);
            }
        }
    }

    /**
     * Handle the approve "updated" event.
     *
     * @param  \App\Models\Approve  $approve
     * @return void
     */
    public function updated(Approve $approve)
    {
        //
    }

    /**
     * Handle the approve "deleted" event.
     *
     * @param  \App\Models\Approve  $approve
     * @return void
     */
    public function deleted(Approve $approve)
    {
        //
    }

    /**
     * Handle the approve "restored" event.
     *
     * @param  \App\Models\Approve  $approve
     * @return void
     */
    public function restored(Approve $approve)
    {
        //
    }

    /**
     * Handle the approve "force deleted" event.
     *
     * @param  \App\Models\Approve  $approve
     * @return void
     */
    public function forceDeleted(Approve $approve)
    {
        //
    }
}
