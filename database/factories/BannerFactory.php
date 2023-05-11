<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerFileName = fake()->image(storage_path("app/public/images/banners"));
        return [
            'name' => fake()->unique()->words(3, true),
            'active_from' => now(),
            'active_to' => null,
            'url' => fake()->url,
            'image_path' => "storage/images/banners/" . basename($fakerFileName)
        ];
    }
}