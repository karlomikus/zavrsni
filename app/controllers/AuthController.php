<?php

class AuthController extends \BaseController {

    /**
     * Authenticate the user
     * @return Response
     */
    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        $credentials = array(
            'email'    => $email,
            'password' => $password,
        );

        try
        {
            Sentry::authenticate($credentials, false);
            $loggedIn = true;
        }
        catch(Exception $e)
        {
            $loggedIn = false;
        }

        return Response::json(array('success' => $loggedIn));
    }

    /**
     * Get information about currently logged in user
     * @return Response
     */
    public function user()
    {
        $user = null;

        try
        {
            $user = Sentry::getUser();
        }
        catch(Exception $e)
        {

        }

        return Response::json(array('user' => $user));
    }

    /**
     * Check if user is logged in
     * @return Response
     */
    public function isLoggedIn()
    {
        return Response::json(Sentry::check());
    }

    /**
     * Logout the user
     * @return Response
     */
    public function logout()
    {
        Sentry::logout();

        return Redirect::to('/');
    }
}