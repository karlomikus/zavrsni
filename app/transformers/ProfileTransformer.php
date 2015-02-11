<?php namespace Transformers;

use Sentry;
use Cartalyst\Sentry\Users\Eloquent\User;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return
        [
            'id'          => (int) $user->id,
            'email'       => $user->email,
            'firstName'   => $user->first_name,
            'lastName'    => $user->last_name,
            'fullName'    => $user->first_name . ' ' . $user->last_name,
            'dob'         => $user->dob,
            'gender'      => $user->gender,
            'website'     => $user->website,
            'facebook'    => $user->facebook,
            'pic'         => $user->pic,
            'description' => $user->description,
            'telephone'   => $user->telephone,
            'address'     => $user->address,
            'city'        => $user->city,
            'postcode'    => (int) $user->postcode,
            'admin'       => (bool) $user->inGroup(Sentry::findGroupByName('Administrators'))
        ];
    }
}