<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogAuthActivity
{


  public function handle($event)
    {
        if ($event instanceof Login) {
            AuditLog::create([
                'performed_by' => $event->user->id,
                'action' => 'login',
                'target_type' => 'User',
                'target_id' => $event->user->id,
                'description' => 'User logged in'
            ]);
        }

        if ($event instanceof Logout) {
            AuditLog::create([
                'performed_by' => $event->user->id ?? null,
                'action' => 'logout',
                'target_type' => 'User',
                'target_id' => $event->user->id ?? null,
                'description' => 'User logged out'
            ]);
        }
    }


    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(object $event): void
    // {
    //     //
    // }
}
