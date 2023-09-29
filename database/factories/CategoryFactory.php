<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'en' => ['title' => $fakerEn->meatName()],
            'fr' => ['title' => $fakerFr->meatName()],
            'de' => ['title' => $fakerDe->meatName()],
            'slug' => $fakerEn->slug(2)
        ];
    }
}
