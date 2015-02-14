<?php

use LaravelBook\Ardent\Ardent;

class Message extends Ardent
{
    protected $guarded = ['id'];

    public static $rules = [
        'to_id' => 'required',
        'project_id' => 'required',
    ];

    public function to()
    {
        return $this->belongsTo('User');
    }

    public function project()
    {
        return $this->belongsTo('Project');
    }
}