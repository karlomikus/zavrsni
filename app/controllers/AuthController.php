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
    public function currentUser()
    {
        try
        {
            $responseStatus = 200;
            $user = Sentry::getUser();

            $response = [
                'email' => $user->email,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
            ];
        }
        catch(Exception $e)
        {
            $responseStatus = 400;
        }
        finally
        {
            return Response::json($response, $responseStatus);
        }
    }

    /**
     * Get information about a user
     * @param $id User ID
     * @return Response
     */
    public function user($id)
    {
        try
        {
            $responseStatus = 200;
            $user = Sentry::findUserById($id);

            $response = [
                'email' => $user->email,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
            ];
        }
        catch(Exception $e)
        {
            $responseStatus = 400;
        }
        finally
        {
            return Response::json($response, $responseStatus);
        }
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