<?php

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 30; $i++)
        {
            Project::create(
            [
                'title'        => $faker->sentence(3),
                'start_date'   => $faker->dateTimeThisYear(),
                'end_date'     => date('Y-m-d H:i:s'),
                'location'     => $faker->city(),
                'user_id'      => $faker->numberBetween(1, 7),
                'tags'         => 'test,tag,plz,ignore,no,copy,pasta',
                'category_id'  => $faker->numberBetween(1, 5),
                'description'  => $faker->text(600),
                'skills'       => $faker->text(400),
                'contact_type' => $faker->randomElement(['email', 'website'])
            ]);
        }
    }
}