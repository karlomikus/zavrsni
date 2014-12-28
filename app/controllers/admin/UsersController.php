<?php namespace Admin;

use User;
use View;

class UsersController extends BaseAdminController
{
	private $user;

	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}

    public function index()
    {
    	$users = $this->user->all();
        return View::make('admin.users.main')->with('users', $users);
    }

    public function create()
    {
    	return View::make('admin.users.form')->with('user', $this->user);
    }

    public function edit($id)
    {
    	$user = $this->user->find($id);
    	return View::make('admin.users.form')->with('user', $user);
    }
} 