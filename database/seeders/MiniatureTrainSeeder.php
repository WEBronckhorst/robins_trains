<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\RailSystem;
use App\Models\Train;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MiniatureTrainSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = require database_path('data/miniature_train_catalog.php');

        $categories = collect();
        foreach ($catalog['categories'] as $row) {
            $categories->put(
                $row['key'],
                Category::query()->create([
                    'Title' => $row['title'],
                    'Description' => $row['description'],
                ]),
            );
        }

        $manufacturers = collect();
        foreach ($catalog['manufacturers'] as $row) {
            $manufacturers->put(
                $row['key'],
                Manufacturer::query()->create([
                    'Title' => $row['title'],
                    'Description' => $row['description'],
                    'Logo' => null,
                ]),
            );
        }

        $railSystems = collect();
        foreach ($catalog['rail_systems'] as $row) {
            $railSystems->put(
                $row['key'],
                RailSystem::query()->create([
                    'Title' => $row['title'],
                    'Description' => $row['description'],
                ]),
            );
        }

        $conditions = ['Nieuw', 'Als nieuw', 'Zeer goed', 'Goed', 'Redelijk'];
        $packaging = ['Originele doos', 'Originele doos', 'Zonder doos', 'Showcase', 'Schadedoos'];

        foreach ($catalog['trains'] as $index => $train) {
            $purchased = Carbon::now()
                ->subYears(random_int(0, 8))
                ->subMonths(random_int(0, 11))
                ->subDays(random_int(0, 28));

            Train::query()->create([
                'category_id' => $categories[$train['category']]->id,
                'manufacturer_id' => $manufacturers[$train['manufacturer']]->id,
                'rail_system_id' => $railSystems[$train['rail_system']]->id,
                'epoch' => $train['epoch'],
                'Title' => $train['title'],
                'Quantity' => $train['quantity'] ?? 1,
                'Description' => $train['description'] ?? null,
                'Image' => null,
                'Scale' => $train['scale'] ?? 'N (1:160)',
                'Country' => $train['country'],
                'Company' => $train['company'],
                'CompanyNumber' => $train['company_number'] ?? null,
                'Color' => $train['color'] ?? null,
                'Decoder' => $train['decoder'] ?? false,
                'ShortDescription' => $train['article'] ?? null,
                'PurchasedDate' => $purchased->format('Y-m-d'),
                'Packaging' => $packaging[$index % count($packaging)],
                'Price' => $train['price'] ?? random_int(25, 350) + (random_int(0, 99) / 100),
                'Condition' => $conditions[$index % count($conditions)],
                'Address' => $train['address'] ?? null,
            ]);
        }
    }
}
