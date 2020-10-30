<?php

namespace App\Listeners;

use App\Events\TaskUpdatedEvent;
use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskUpdatedListener
{

    public function __construct()
    {
        //
    }


    public function handle(TaskUpdatedEvent $event)
    {
        $d_event = new Event;
        $d_event->task_id = $event->task->id;
        $d_event->operation = $event->task->name. ' maddeli kayıt guncellenmiştir.';
        $d_event->save();
    }
}
