<?php namespace Admin;

use View;

class CategoriesController extends BaseAdminController
{
	public function index()
	{
		return View::make('admin.categories.main');
	}
}