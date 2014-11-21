<?php

class ProjectsController extends \BaseController
{
	/**
	 * Display a listing of the project.
	 *
	 * @return Response
	 */
	public function index()
    {
        $projects = Project::get();

        foreach ($projects as $project)
        {
            if(!empty($project->tags))
            {
                $project->tags = explode(',', $project->tags);
            }
        }

		return Response::json($projects);
	}

	/**
	 * Store a newly created project in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(!Sentry::check()) return Response::json(array('success' => false));

        $saved          = true;
        $errors         = null;
        $title          = Input::get('title');
        $description    = Input::get('description');
        $skills         = Input::get('skills');
        $category       = Input::get('category');
        $tags           = Input::get('tags');
        $userId         = Sentry::getUser()->id;

        try
        {
            $project = new Project();

            $project->title = $title;
            $project->description = $description . "\n" . $skills;
            $project->tags = $tags;
            $project->user_id = $userId;
            $project->category_id = $category;

            $project->save();
        }
        catch(Exception $e)
        {
            $saved = false;
            $errors = $e->getMessage();
        }

        return Response::json(array('success' => $saved, 'errors' => $errors));
	}

	/**
	 * Display the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Project::find($id));
	}

	/**
	 * Update the specified project in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $saved          = true;
        $errors         = null;
        $title          = Input::get('title');
        $description    = Input::get('description');
        $skills         = Input::get('skills');
        $category       = Input::get('category');
        $tags           = Input::get('tags');
        $userId         = Sentry::getUser()->id;

        try
        {
            $project = Project::find($id);

            $project->title = $title;
            $project->description = $description . "\n" . $skills;
            $project->tags = $tags;
            $project->category_id = $category;

            $project->save();
        }
        catch(Exception $e)
        {
            $saved = false;
            $errors = $e->getMessage();
        }

        return Response::json(array('success' => $saved, 'errors' => $errors));
	}

	/**
	 * Remove the specified project from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(!Sentry::check()) return Response::json(array('success' => false));

        $success    = true;
        $errors     = null;

        try
        {
            Project::destroy($id);
        }
        catch(Exception $e)
        {
            $success = false;
            $errors = $e->getMessage();
        }

        return Response::json(array('success' => $success, 'errors' => $errors));
	}
}
