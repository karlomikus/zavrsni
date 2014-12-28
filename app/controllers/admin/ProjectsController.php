<?php namespace Admin;

use Project;
use View;

class ProjectsController extends BaseAdminController
{
	private $project;

	public function __construct(Project $project)
	{
		parent::__construct();
		$this->project = $project;
	}

    public function index()
    {
    	$projects = $this->project->orderBy('title', 'asc')->get();
        return View::make('admin.projects.main')->with('projects', $projects);
    }
} 