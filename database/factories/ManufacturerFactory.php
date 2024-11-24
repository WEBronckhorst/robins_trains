<?php

namespace Database\Factories;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Manufacturer;

class ManufacturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Manufacturer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $getCompanyInitials = function ($name) {
            $initials = '';

            foreach (explode(' ', $name) as $word) {
                $initials .= $word[0];
            }

            return $initials;
        };

        $title = fake()->company();
        $logo = fake()->imageUrl(1000, 1000, $getCompanyInitials($title) );

        return [
            'Title' => $title,
            'Description' => fake()->text(),
            'Logo' => $logo,
        ];
    }
}
