<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rating', 'comment', 'rated_user_id', 'rater_user_id', 'task_id'];
    protected $table = 'ratings';
    public function ratedUser(){
        return $this->belongsTo(User::class, 'rated_user_id');
    }
    public function raterUser(){
        return $this->belongsTo(User::class, 'rater_user_id');
    }
}
