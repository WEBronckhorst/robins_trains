<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class TrainsByCategoryChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Treinen per categorie';

    protected ?string $maxHeight = '300px';

    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 2,
    ];

    protected function getData(): array
    {
        $categories = Category::query()
            ->withCount('trains')
            ->orderByDesc('trains_count')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Aantal treinen',
                    'data' => $categories->pluck('trains_count')->all(),
                    'backgroundColor' => [
                        '#f59e0b',
                        '#d97706',
                        '#b45309',
                        '#92400e',
                        '#78350f',
                        '#451a03',
                    ],
                ],
            ],
            'labels' => $categories->pluck('Title')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
