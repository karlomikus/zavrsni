<?php

use Transformers\ProfileTransformer;

class AuthController extends ApiController
{
    /**
     * Authenticate the user. Returns users information
     * on succesful authentication.
     *
     * @return Response
     */
    public function login()
    {
        $user     = null;
        $email    = Input::get('email');
        $password = Input::get('password');

        $credentials = array(
            'email'    => $email,
            'password' => $password,
        );

        try
        {
            $user = Sentry::authenticate($credentials, false);
        }
        catch(Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithItem($user, new ProfileTransformer());
    }

    /**
     * Get information about currently logged in user
     *
     * @return Response
     */
    public function currentUser()
    {
        $user = Sentry::getUser();

        if(!$user)
            return $this->respondWithError('No valid user session found!');

        return $this->respondWithItem($user, new ProfileTransformer());
    }

    /**
     * Get information about a user
     *
     * @param $id User ID
     * @return Response
     */
    public function user($id)
    {
        try
        {
            $user = Sentry::findUserById($id);
        }
        catch(Exception $e)
        {
            return $this->respondWithError('No valid user information found!');
        }

        return $this->respondWithItem($user, new ProfileTransformer());
    }

    /**
     * Register a new user
     *
     * @return Response
     */
    public function register()
    {
        try
        {
            $email          = Input::get('email');
            $password       = Input::get('password');

            // Register and activate the user
            Sentry::register(
            [
                'email'    => $email,
                'password' => $password,
            ], true);
        }
        catch (Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }

        return $this->respondWithArray(['success' => true]);
    }

    /**
     * Logout the user
     *
     * @return Response
     */
    public function logout()
    {
        Sentry::logout();
        return $this->respondWithArray(['loggedIn' => Sentry::check()]);
    }
}