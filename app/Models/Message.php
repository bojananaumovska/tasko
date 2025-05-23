<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'reciever_id',
        'task_id',
        'message',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }
}
