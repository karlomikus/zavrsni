<?php

use Transformers\ProjectTransformer;

class ProfileController extends ApiController
{
	public function userProjects($userId)
	{
		try
        {
            $projects = Project::where('user_id', '=', $userId)->get();
        }
        catch(Exception $e)
        {
            $this->setStatusCode(400);
        }
        finally
        {
            return $this->respondWithCollection($projects, new ProjectTransformer());
        }
	}
}