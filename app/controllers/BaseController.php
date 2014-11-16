<?php

class BaseController extends Controller {

    public $user;

    function __construct()
    {
        $this->user = null;

        if(Sentry::check())
            $this->user = Sentry::getUser();

        // Share user data across all views
        View::share('user', $this->user);
    }

    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
