<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\TaskCreatedEvent;
use App\Events\TaskUpdatedEvent;
use App\Events\TaskCompletedEvent;
use App\Events\TaskDeletedEvent;


class Task extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => TaskCreatedEvent::class,
        'updated' => TaskUpdatedEvent::class,
        'completed' => TaskCompletedEvent::class,
        'deleted' => TaskDeletedEvent::class,
    ];

}
