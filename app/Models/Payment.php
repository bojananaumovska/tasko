<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['task_id', 'payer_id', 'receiver_id', 'amount', 'paid_at'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
