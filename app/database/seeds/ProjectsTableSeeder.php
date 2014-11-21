<?php

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 6; $i++)
        {
            Project::create(array(
                'title' => $faker->sentence(3),
                'user_id' => 1,
                'tags' => 'test,tag,plz,ignore,no,copy,pasta',
                'description' => $faker->paragraph()
            ));
        }
    }
}