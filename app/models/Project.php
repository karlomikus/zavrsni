<?php
use LaravelBook\Ardent\Ardent;

class Project extends Ardent
{
    protected $guarded = ['id'];

    public static $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:3',
        'category_id' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function messages()
    {
        return $this->hasMany('Message');
    }
}