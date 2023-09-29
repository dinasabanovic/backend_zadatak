<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFr = Faker::create('fr_FR');
        $fakerFr->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($fakerFr));

        
        $fakerEn = Faker::create('en_US');
        $fakerEn->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($fakerEn));

        
        $fakerDe = Faker::create('de_DE');
        $fakerDe->addProvider(new \FakerRestaurant\Provider\de_DE\Restaurant($fakerDe));

        return [
            'category_id' => Category::all()->random()->id,
            'en' => [
                'title' => $fakerEn->foodName(),
                'description' => $fakerEn->paragraph()
            ],
            'fr' => [
                'title' => $fakerFr->foodName(),
                'description' => $fakerFr->paragraph()
            ],
            'de' => [
                'title' => $fakerDe->foodName(),
                'description' => $fakerDe->paragraph()
            ],
        ];

    }
}
