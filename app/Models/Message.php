<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'task_owner_id',
        'task_worker_id',
        'task_id',
        'message',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function taskOwner()
    {
        return $this->belongsTo(User::class, 'task_owner_id');
    }

    public function taskWorker()
    {
        return $this->belongsTo(User::class, 'task_worker_id');
    }
}
