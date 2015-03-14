<?php

use Transformers\MessageTransformer;

class MessagesController extends ApiController
{
    /**
     * Display a listing of the messages for specified project.
     *
     * @return Response
     */
    public function index($forProjectId)
    {
        $messages = Message::orderBy('created_at', 'DESC')->where('project_id', '=', $forProjectId)->get();
        
        if(!$messages)
            return $this->respondWithError('No messages found for the given ID!');

        return $this->respondWithCollection($messages, new MessageTransformer());
    }

    /**
     * Store a newly created message in storage.
     *
     * @return Response
     */
    public function store($projectId)
    {
        try
        {
            $msg = new Message();

            $msg->full_name  = Input::get('fullname');
            $msg->email      = Input::get('email');
            $msg->cv         = Input::get('cv');
            $msg->message    = Input::get('msg');
            $msg->project_id = $projectId;

            $msg->save();
        }
        catch (Exception $e)
        {
            return $this->respondWithError($e->getMessage());
        }
        
        return $this->respondWithArray([]);
    }

    /**
     * Display the specified message.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        if(!$message)
            return $this->respondWithError('No message found for the given ID!');
        
        return $this->respondWithItem($message, new MessageTransformer());
    }
}