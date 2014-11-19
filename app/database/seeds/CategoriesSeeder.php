<?php

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        Category::create(array(
            'name' => 'Outdoor',
            'description' => $faker->paragraph()
        ));

        Category::create(array(
            'name' => 'Development',
            'description' => $faker->paragraph()
        ));

        Category::create(array(
            'name' => 'Job opportunity',
            'description' => $faker->paragraph()
        ));

        Category::create(array(
            'name' => 'Design',
            'description' => $faker->paragraph()
        ));

        Category::create(array(
            'name' => 'Interior design',
            'description' => $faker->paragraph()
        ));
    }
}