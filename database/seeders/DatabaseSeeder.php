<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\RailSystem;
use App\Models\Train;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Nick',
            'email' => 'info@webronckhorst.nl',
            'password' => Hash::make('110ik110'),
        ]);

        Category::factory(10)->create();
        Manufacturer::factory(25)->create();
        RailSystem::factory(5)->create();
        Train::factory(300)->create();
    }
}
