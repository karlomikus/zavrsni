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
        try
        {
            $responseStatus = 200;
            $response = [];
            $projects = Project::get();

            foreach ($projects as $project)
            {
                $response[] = [
                    'id' => $project->id,
                    'user' => $project->user->first_name . ' ' . $project->user->last_name,
                    'userId' => $project->user->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'category' => $project->category->name,
                    'categoryId' => $project->category->id,
                    'tags' => explode(',', $project->tags),
                    'date' => date_format($project->created_at, 'd.m.Y'),
                ];
            }
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

    /**
     * Store a newly created project in storage.
     *
     * @return Response
     */
    public function store()
    {
        try
        {
            $responseStatus = 200;
            $title          = Input::get('title');
            $description    = Input::get('description');
            $skills         = Input::get('skills');
            $category       = Input::get('categoryId');
            $tags           = Input::get('tags');
            $userId         = Sentry::getUser()->id;

            $project = new Project();

            $project->title = $title;
            $project->description = $description . "\n" . $skills;
            $project->tags = $tags;
            $project->user_id = $userId;
            $project->category_id = $category;

            $project->save();
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
     * Display the specified project.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $responseStatus = 200;
            $project = Project::find($id);

            $response = [
                'id' => $project->id,
                'user' => $project->user->first_name . ' ' . $project->user->last_name,
                'userId' => $project->user->id,
                'title' => $project->title,
                'description' => $project->description,
                'category' => $project->category->name,
                'categoryId' => $project->category->id,
                'tags' => explode(',', $project->tags),
                'date' => date_format($project->created_at, 'd.m.Y'),
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