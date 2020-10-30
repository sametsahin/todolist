<?php

namespace App\Listeners;

use App\Events\TaskCompletedEvent;
use App\Models\Event;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskCompletedListener
{
    public function __construct()
    {
        //
    }

    public function handle(TaskCompletedEvent $event)
    {
        $d_event = new Event;
        $d_event->task_id = $event->task->id;
        $d_event->operation = $event->task->name. ' maddeli kayıt basarılmıstır.';
        $d_event->save();
    }
}
