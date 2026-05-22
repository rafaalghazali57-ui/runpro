<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [

        'user_id',
        'title',
        'description',

        'priority',
        'xp',

        'completed',

        'start_date',
        'start_time',

        'end_date',
        'end_time',

    ];
}