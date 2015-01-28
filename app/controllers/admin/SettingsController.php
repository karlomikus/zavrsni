<?php namespace Admin;

use View;

class SettingsController extends BaseAdminController
{
	public function index()
	{
		return View::make('admin.settings.main');
	}
}