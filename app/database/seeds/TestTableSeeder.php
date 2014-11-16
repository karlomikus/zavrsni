<?php

class TestTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 12; $i++)
        {
            Test::create(array(
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph(),
                'active' => 'yes',
                'author' => $faker->randomDigit
            ));
        }
    }
}