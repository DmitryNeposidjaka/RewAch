<?php

namespace App\Observers;

use App\Models\Achievement;
use App\Models\Approve;
use App\Models\Reward;

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
        if($entity && $approve->entity_type == Achievement::class) {
            /**
             * @var $entity Achievement
             */
            if(count($entity->approves) == intval(config('app.approves.achievement'))) {
                $entity->approve();
            }
        } elseif($entity && $approve->entity_type == Reward::class) {
            /**
             * @var $entity Reward
             */
            if(count($entity->approves) != intval(config('app.approves.rewards'))) {
                $entity->approve();
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
        $entity = $approve->entity;
        if($entity && $approve->entity_type == Achievement::class) {
            /**
             * @var $entity Achievement
             */
            if(count($entity->approves) != intval(config('app.approves.achievement'))) {
                $entity->disApprove();
            }
        } elseif($entity && $approve->entity_type == Reward::class) {
            /**
             * @var $entity Reward
             */
            if(count($entity->approves) != intval(config('app.approves.rewards'))) {
                $entity->disApprove();
            }
        }
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
