<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\Tag;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meal::factory(40)->create();
        $tags = Tag::all();
        $ingredients = Ingredient::all();

        Meal::all()->each(function ($meal) use ($tags) { 
            $meal->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });

        Meal::all()->each(function ($meal) use ($ingredients) { 
            $meal->ingredients()->attach(
                $ingredients->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
