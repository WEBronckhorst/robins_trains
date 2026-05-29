<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TrainResource;
use App\Models\Train;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentTrainsTable extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Train::query()->latest()->limit(5))
            ->heading('Recent toegevoegd')
            ->paginated(false)
            ->columns([
                Tables\Columns\ImageColumn::make('Image')
                    ->label('Foto')
                    ->square()
                    ->height(40),
                Tables\Columns\TextColumn::make('Title')
                    ->label('Titel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Manufacturer.Title')
                    ->label('Merk'),
                Tables\Columns\TextColumn::make('Price')
                    ->label('Prijs')
                    ->money('EUR', locale: 'nl'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Toegevoegd')
                    ->since(),
            ])
            ->recordUrl(fn (Train $record): string => TrainResource::getUrl('view', ['record' => $record]));
    }
}
