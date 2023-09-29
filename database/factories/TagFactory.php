<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFr = Faker::create('fr_FR');
        $fakerEn = Faker::create('en_US');
        $fakerDe = Faker::create('de_DE');

        return [
            'en' => ['title' => $fakerEn->word()],
            'fr' => ['title' => $fakerFr->word()],
            'de' => ['title' => $fakerDe->word()],
            'slug' => $fakerEn->slug(2)
        ];
    }
}
