<?php namespace Transformers;

use Message;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    public function transform(Message $msg)
    {
        return
        [
            'id'        => (int) $msg->id,
            'to'        => (int) $msg->to->id,
            'project'   => $msg->project->title,
            'projectID' => (int) $msg->project->id,
            'email'     => $msg->email,
            'fullName'  => $msg->full_name,
            'CV'        => $msg->cv,
            'message'   => $msg->message
        ];
    }
}