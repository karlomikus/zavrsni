<?php

use Transformers\ProfileTransformer;

class AuthController extends ApiController
{
    /**
     * Authenticate the user
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
            $user = $e->getMessage();
        }

        return Response::json($user);
    }

    /**
     * Get information about currently logged in user
     *
     * @return Response
     */
    public function currentUser()
    {
        try
        {
            $user = Sentry::getUser();
        }
        catch(Exception $e)
        {
            $this->setStatusCode(400);
        }
        finally
        {
            if($user != null)
                return $this->respondWithItem($user, new ProfileTransformer());
            return Response::json(null);
        }
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
            $responseStatus = 200;
            $user = Sentry::findUserById($id);

            $response = [
                'email' => $user->email,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'gender' => $user->gender,
                'dob' => $user->dob,
                'telephone' => $user->telephone,
                'address' => $user->address,
                'city' => $user->city,
                'postcode' => $user->postcode,
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

    public function register()
    {
        try
        {
            $responseStatus = 200;
            $email          = Input::get('email');
            $password       = Input::get('password');

            $user = Sentry::register(array(
                'email'    => $email,
                'password' => $password,
            ), true);
        }
        catch (Exception $e)
        {
            $responseStatus = 400;
        }
        finally
        {
            return Response::json(null, $responseStatus);
        }
    }

    /**
     * Check if user is logged in
     *
     * @return Response
     */
    public function isLoggedIn()
    {
        return Response::json(Sentry::check() ? true : null);
    }

    /**
     * Logout the user
     *
     * @return Response
     */
    public function logout()
    {
        Sentry::logout();

        return Redirect::to('/');
    }
}