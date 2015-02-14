<?php

use Transformers\MessageTransformer;

class MessagesController extends ApiController
{
    /**
     * Display a listing of the projects.
     *
     * @return Response
     */
    public function index($forUserId)
    {
        try
        {
            $messages = Message::orderBy('created_at', 'DESC')->where('to_id', '=', $forUserId)->get();
        }
        catch(Exception $e)
        {
            $this->setStatusCode(400);
        }
        finally
        {
            return $this->respondWithCollection($messages, new MessageTransformer());
        }
    }

    /**
     * Store a newly created project in storage.
     *
     * @return Response
     */
    public function store($toUserId, $projectId)
    {
        try
        {
            $responseStatus = 200;
            $msg = new Message();

            $msg->full_name  = Input::get('fullname');
            $msg->email      = Input::get('email');
            $msg->cv         = Input::get('cv');
            $msg->message    = Input::get('msg');
            $msg->to_id      = $toUserId;
            $msg->project_id = $projectId;

            $msg->save();
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
            $message = Message::find($id);
        }
        catch(Exception $e)
        {
            $this->setStatusCode(400);
        }
        finally
        {
            return $this->respondWithItem($message, new MessageTransformer());
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
        try
        {
            $responseStatus = 200;
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
            $responseStatus = 400;
        }
        finally
        {
            return Response::json(null, $responseStatus);
        }
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
            $responseStatus = 200;
            Project::destroy($id);
        }
        catch(Exception $e)
        {
            $responseStatus = 400;
        }
        finally
        {
            return Response::json(null, $responseStatus);
        }
    }
}