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
    public function loggedInUser()
    {
        $userResp = null;

        try
        {
            $user = Sentry::getUser();

            // We don't want all user information
            $userResp = new stdClass;
            $userResp->email = $user->email;
            $userResp->firstName = $user->first_name;
            $userResp->lastName = $user->last_name;
        }
        catch(Exception $e)
        {

        }

        return Response::json($userResp);
    }

    /**
     * Get information about a user
     * @param $id User ID
     * @return Response
     */
    public function user($id)
    {
        $userResp = null;

        try
        {
            $user = Sentry::findUserById($id);

            // We don't want all user information
            $userResp = new stdClass;
            $userResp->email = $user->email;
            $userResp->firstName = $user->first_name;
            $userResp->lastName = $user->last_name;
        }
        catch(Exception $e)
        {
        }

        return Response::json($userResp);
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