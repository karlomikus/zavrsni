<?php

use LaravelBook\Ardent\Ardent;

class User extends Ardent
{
	protected $table = 'users';

	protected $guarded = ['id'];

	protected $hidden = ['password', 'created_at'];

	public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

    public function getIsBannedAttribute()
    {
        $throttle = Sentry::findThrottlerByUserId($this->id);
        return $throttle->isBanned();
    }
}
