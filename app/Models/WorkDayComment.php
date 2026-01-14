<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDayComment extends Model
{
    protected $fillable = ['work_day_id', 'user_id', 'body'];

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
