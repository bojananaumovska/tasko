<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [ 'title', 'description', 'category_id', 'user_id',
     'budget', 'due_date', 'due_time', 'location', 'estimated_time' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
