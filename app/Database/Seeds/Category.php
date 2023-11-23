<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Category extends Seeder
{
    public function run()
    {
        $model = new \App\Models\CategoryModel();
        $categoryTitle = ['Rapat Kerja', 'Rapat Koordinasi', 'Rapat Evaluasi', 'Rapat Harian', 'Rapat Bulanan', 'Rapat Tahunan'];

        foreach($categoryTitle as $title) {
            $model->insert([
                'title' => $title,
                'user_id' => 1
            ]);
        }
    }
}
