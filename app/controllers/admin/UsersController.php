<?php namespace Admin;

use User;
use View;
use Redirect;
use Sentry;
use Input;
use Exception;

class UsersController extends BaseAdminController
{
	private $user;

	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

    /**
     * Render view with users list
     * 
     * @return View
     */
    public function index()
    {
    	$users = $this->user->paginate(15);
        return View::make('admin.users.main')->with('users', $users);
    }

    /**
     * Render create form view
     * 
     * @return View
     */
    public function create()
    {
    	return View::make('admin.users.form')->with('user', $this->user);
    }

    /**
     * Save the user to database
     * 
     * @return Redirect Redirects back to list
     */
    public function store()
    {
        try
        {
            $error = null;
            $usersGroup = Sentry::findGroupById(2);

            $newUser = Sentry::createUser([
                'email'     => Input::get('email'),
                'password'  => '123456',
                'activated' => true,
                'first_name'=> Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'gender'    => Input::get('gender'),
                'dob'       => Input::get('dob'),
                'telephone' => Input::get('telephone'),
                'address'   => Input::get('address'),
                'city'      => Input::get('city'),
                'postcode'  => Input::get('postcode')
            ]);

            $newUser->addGroup($usersGroup);
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }

        return Redirect::to('admin/users')->with('error', $error);
    }

    /**
     * Render user edit form
     * 
     * @param  int $id UserID
     * @return View
     */
    public function edit($id)
    {
    	$user = $this->user->find($id);
    	return View::make('admin.users.form')->with('user', $user);
    }

    /**
     * Update user information in database
     * 
     * @param  int $id UserID
     * @return Redirect Redirects back to users list
     */
    public function update($id)
    {
        try
        {
            $error = null;
            $user = Sentry::findUserById($id);

            $user->email      = Input::get('email');
            $user->first_name = Input::get('first_name');
            $user->last_name  = Input::get('last_name');
            $user->gender     = Input::get('gender');
            $user->dob        = Input::get('dob');
            $user->city       = Input::get('city');
            $user->address    = Input::get('address');
            $user->telephone  = Input::get('telephone');
            $user->postcode   = Input::get('postcode');

            $user->save();
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }

        return Redirect::to('admin/users')->with('error', $error);
    }

    /**
     * Ban/unban the user depending on his current ban status
     * 
     * @param  int $id UserID
     * @return Redirect     Redirects back to users list
     */
    public function changeBanStatus($id)
    {
        try
        {
            $error = null;
            $throttle = Sentry::findThrottlerByUserId($id);
            if($throttle->isBanned())
                $throttle->unBan();
            else
                $throttle->ban();
        }
        catch (Exception $e)
        {
            $error = 'User was not found.';
        }

        return Redirect::to('admin/users')->with('error', $error);
    }

    /**
     * Delets the user
     * 
     * @param  int $id UserID
     * @return Redirect     Redirects back to users list
     */
    public function destroy($id)
    {
        try
        {
            $error = null;
            $user = Sentry::findUserById($id);
            $user->delete();
        }
        catch (Exception $e)
        {
            $error = 'User was not found.';
        }

        return Redirect::to('admin/users')->with('error', $error);
    }
} 