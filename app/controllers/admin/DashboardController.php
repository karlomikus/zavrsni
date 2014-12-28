<?php namespace Admin;

class DashboardController extends BaseAdminController
{
    public function index()
    {
        return \View::make('admin.dashboard.main');
    }
} 