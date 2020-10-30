<?php

namespace App\Listeners;

use App\Events\TaskDeletedEvent;
use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskDeletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(TaskDeletedEvent $event)
    {
        $d_event = new Event;
        $d_event->task_id = $event->task->id;
        $d_event->operation = $event->task->name. ' maddeli kayıt silinmiştir.';
        $d_event->save();
    }
}
