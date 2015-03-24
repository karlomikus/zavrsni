<?php

use Transformers\ProjectTransformer;

class ProjectsController extends ApiController
{
    /**
     * Display a listing of the projects.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC')->get();

        if(!$projects)
            return $this->respondWithError("No projects found!");
        
        return $this->respondWithCollection($projects, new ProjectTransformer());
    }

    /**
     * Store a newly created project in storage.
     *
     * @return Response
     */
    public function store()
    {
        try
        {
            $title          = Input::get('title');
            $description    = Input::get('description');
            $skills         = Input::get('skills');
            $category       = Input::get('categoryId');
            $tags           = Input::get('tags');
            $startDate      = Input::get('startDate');
            $endDate        = Input::get('endDate');
            $location       = Input::get('location');
            $userId         = Sentry::getUser()->id;

            $project = new Project();

            $project->title       = $title;
            $project->description = $description;
            $project->skills      = $skills;
            $project->tags        = $tags;
            $project->user_id     = $userId;
            $project->category_id = $category;
            $project->start_date  = $startDate;
            $project->end_date    = $endDate;
            $project->location    = $location;

            $project->save();
        }
        catch (Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }
        
        return $this->respondWithArray([]);
    }

    /**
     * Display the specified project.
     *
     * @param  int  $id Project ID
     * @return Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        if(!$project)
            $this->respondWithError("No project found with given ID!");
        
        return $this->respondWithItem($project, new ProjectTransformer());
    }

    /**
     * Update the specified project in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            $title          = Input::get('title');
            $description    = Input::get('description');
            $skills         = Input::get('skills');
            $category       = Input::get('categoryId');
            $tags           = Input::get('tags');
            $startDate      = Input::get('startDate');
            $endDate        = Input::get('endDate');
            $location       = Input::get('location');

            $project = Project::find($id);

            $project->title       = $title;
            $project->description = $description;
            $project->skills      = $skills;
            $project->tags        = $tags;
            $project->category_id = $category;
            $project->start_date  = $startDate;
            $project->end_date    = $endDate;
            $project->location    = $location;

            $project->save();
        }
        catch (Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }
        
        return $this->respondWithArray([]);
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            // Delete the related messages
            Message::where('project_id', '=', $id)->delete();
            Project::destroy($id);
        }
        catch(Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }
        
        return $this->respondWithArray([]);
    }
}