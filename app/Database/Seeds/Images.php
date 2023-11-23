<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Images extends Seeder
{
    public function run()
    {
        $modelCategory = new \App\Models\CategoryModel();
        $category = $modelCategory->findAll();
        $listCategory = [$category[0]->id, $category[1]->id, $category[2]->id, $category[3]->id, $category[4]->id, $category[5]->id];

        $model = new \App\Models\ImageModel();
        $faker = \Faker\Factory::create('id_ID');
        $listImages = ['IMG_8907.JPG', 'IMG_8913.JPG', 'IMG_8917.JPG', 'IMG_8919.JPG', 'IMG_8923.JPG', 'IMG_8925.JPG', 'IMG_8934.JPG', 'IMG_8946.JPG', 'IMG_8952.JPG', 'IMG_8955.JPG', 'IMG_8958.JPG', 'IMG_8959.JPG'];

        for ($i = 0; $i < count($listImages); $i++) {
            $model->insert([
                'user_id' => 1,
                'category_id' => $listCategory[$i % 6],
                'image' => $listImages[$i], 
                'description' => $faker->text(100), 
                'file_name' => $listImages[$i], 
                'file_size' => rand(1000, 1000000),
                'deleteRequest' => 0
            ]);
        }
    }
}
