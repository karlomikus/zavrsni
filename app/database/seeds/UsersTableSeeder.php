<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create the groups
        Sentry::createGroup(array(
            'name'        => 'Administrators',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
            ),
        ));

        Sentry::createGroup(array(
            'name'        => 'Users',
            'permissions' => array(
                'admin' => 0,
                'users' => 1,
            ),
        ));

        // Add admin
        $admin = Sentry::createUser(array(
            'email'     => 'admin@admin.com',
            'password'  => 'admin123',
            'activated' => true,
            'first_name'=> 'Karlo',
            'last_name' => 'Mikuš'
        ));
        $adminGroup = Sentry::findGroupById(1);
        $admin->addGroup($adminGroup);

        // Add users
        $faker = Faker\Factory::create();
        $usersGroup = Sentry::findGroupById(2);

        for ($i = 0; $i < 7; $i++)
        {
            Sentry::createUser(array(
                'email'     => $faker->email(),
                'password'  => '123456',
                'activated' => true,
                'first_name'=> $faker->firstName(),
                'last_name' => $faker->lastName()
            ));

            $admin->addGroup($usersGroup);
        }
    }
}