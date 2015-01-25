<?php namespace Admin;

use Project;
use View;
use Redirect;

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

    public function destroy($id)
    {
        $project = $this->project->find($id);
        $project->delete();
        return Redirect::to('admin/projects');
    }
} 