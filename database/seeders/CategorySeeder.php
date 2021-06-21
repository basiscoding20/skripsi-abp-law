<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Category::count();

        if(!$count){
            $categories = [
                [
                    'name' => 'pidana', 
                    'description' => 'Pidana', 
                ],
                [
                    'name' => 'perdata', 
                    'description' => 'Perdata', 
                ]
            ];
    
            foreach($categories as $category){
                Category::create($category);
            }
        }
    }
}
