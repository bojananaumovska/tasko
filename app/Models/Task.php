<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [ 'title', 'description', 'category_id', 'user_id',
     'budget', 'due_date', 'due_time', 'location', 'estimated_time' ];
}
