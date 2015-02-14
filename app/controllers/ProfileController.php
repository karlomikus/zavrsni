<?php

use Transformers\ProjectTransformer;

class ProfileController extends ApiController
{
    public function update()
    {
        try
        {
            $error = null;
            $user = Sentry::getUser();

            $user->email      = Input::get('email');
            $user->first_name = Input::get('firstName');
            $user->last_name  = Input::get('lastName');
            $user->gender     = Input::get('gender');
            $user->dob        = Input::get('dob');
            // $user->city       = Input::get('city');
            // $user->address    = Input::get('address');
            // $user->telephone  = Input::get('telephone');
            // $user->postcode   = Input::get('postcode');
            $user->website     = Input::get('website');
            $user->facebook    = Input::get('facebook');
            $user->description = Input::get('description');

            // $picture = Input::get('pic');

            // if($picture)
            // {
            //     $base64Image = substr($picture, strpos($picture, ",") + 1);
            //     $image = base64_decode($picture);
            //     $destinationPath = public_path() . '/uploads';
            //     $img = Image::make($picture);
            //     //$fileName = $user->id;
            //     //$file->move($destinationPath, $fileName);
            // }

            $user->save();
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
        }
    }

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