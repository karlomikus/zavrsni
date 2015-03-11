<?php

use LaravelBook\Ardent\Ardent;

class Message extends Ardent
{
    protected $guarded = ['id'];

    public static $rules = [
        'project_id' => 'required',
    ];

    public function project()
    {
        return $this->belongsTo('Project');
    }
}