<?php

namespace App\Filament\Widgets;

use App\Models\Manufacturer;
use App\Models\Train;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class TrainStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalTrains = Train::query()->sum('Quantity');
        $collectionValue = Train::query()
            ->selectRaw('SUM(Price * Quantity) as total')
            ->value('total');
        $withDecoder = Train::query()->where('Decoder', true)->count();

        return [
            Stat::make('Treinen in collectie', Number::format($totalTrains))
                ->description('Totaal aantal stuks')
                ->descriptionIcon('heroicon-m-queue-list')
                ->color('primary'),
            Stat::make('Collectiewaarde', Number::currency($collectionValue ?? 0, 'EUR', 'nl'))
                ->description('Som van prijs × aantal')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Met decoder', Number::format($withDecoder))
                ->description('Digitaal bestuurbaar')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('warning'),
            Stat::make('Merken', Number::format(Manufacturer::query()->count()))
                ->description('Verschillende fabrikanten')
                ->descriptionIcon('gameicon-factory')
                ->color('info'),
        ];
    }
}
