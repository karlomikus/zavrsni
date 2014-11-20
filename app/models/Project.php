<?php
use LaravelBook\Ardent\Ardent;

class Project extends Ardent
{
    public function category()
    {
        return $this->hasOne('Category');
    }
}