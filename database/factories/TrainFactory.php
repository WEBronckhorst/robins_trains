<?php

namespace Database\Factories;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\RailSystem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Train;

class TrainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Train::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
//        $imageFaker = new ImageFaker(new Picsum());


        $getCompanyInitials = function ($name) {
            $initials = '';

            foreach (explode(' ', $name) as $word) {
                $initials .= $word[0];
            }

            return $initials;
        };

        $title = fake()->words(3, true);
        $logo = fake()->imageUrl(1000, 1000, $getCompanyInitials($title), true);

        return [
            'category_id' =>  rand(1, Category::count()),
            'manufacturer_id' =>  rand(1, Manufacturer::count()),
            'rail_system_id' => rand(1, RailSystem::count()),
            'Title' => $title,
            'Quantity' => fake()->numberBetween(1, 10),
            'Description' => fake()->text(300),
            'Image' =>  $logo,
            'Scale' => fake()->numberBetween(10, 1000),
            'Country' => fake()->word(),
            'Company' => fake()->word(),
            'CompanyNumber' => fake()->numberBetween(0, 7),
            'Color' => fake()->hexColor(),
            'Decoder' => fake()->boolean(),
            'ShortDescription' => fake()->text( 100),
            'PurchasedDate' => fake()->dateTimeBetween('-3 years', 'yesterday')->format('Y-m-d'),
            'Packaging' => fake()->word(),
            'Condition' => fake()->word(),
            'PurchasedFor' => fake()->word(),
            'Address' => fake()->word(),
        ];
    }
}
