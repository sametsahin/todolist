<?php

namespace App\Listeners;

use App\Events\TaskCreatedEvent;
use App\Models\Event;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskCreatedListener
{

    public function __construct()
    {
        //
    }

    public function handle(TaskCreatedEvent $event)
    {
        $d_event = new Event;
        $d_event->task_id = $event->task->id;
        $d_event->operation = $event->task->name. ' maddeli kayıt olusturulmustur.';
        $d_event->save();
    }
}
