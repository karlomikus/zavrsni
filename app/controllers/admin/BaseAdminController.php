<?php namespace Admin;

use Sentry;
use View;

class BaseAdminController extends \Controller {

    private $currentUser;

    function __construct()
    {
        $this->currentUser = null;

        if(Sentry::check())
            $this->currentUser = Sentry::getUser();

        // Share user data across all views
        View::share('currentUser', $this->currentUser);
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
