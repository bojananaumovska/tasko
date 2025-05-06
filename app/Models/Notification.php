<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'message'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sendNotification(string $id,string $message)
    {
        Notification::create([
            'user_id' => $id,
            'message' => $message,
            'created_at' => now()
        ]);
        return 0;
    }
}
