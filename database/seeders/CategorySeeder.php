<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "Machine Learning",
            'slug' => "machine-learning",
            'color' => '#d0cf49ff'
        ]);

        Category::create([
            'name' => "Decision Support System",
            'slug' => "decision-support-system",
            'color' => '#68ef89ff'
        ]);

        Category::create([
            'name' => "Big Data",
            'slug' => "big-data",
            'color' => '#ff5000ff'
        ]);

        Category::create([
            'name' => "Internet Of Things",
            'slug' => "internet-of-things",
            'color' => '#61c6dfff'
        ]);

        Category::create([
            'name' => "Economics",
            'slug' => "economics",
            'color' => '#d4cd00ff'
        ]);
    }
}
