<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainResource\Pages;
use App\Models\Train;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class TrainResource extends Resource
{
    protected static ?string $model = Train::class;

    protected static string|BackedEnum|null $navigationIcon = 'wi-train';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(Train::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('Image'),
                Tables\Columns\TextColumn::make('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Quantity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Prise')
                    ->getStateUsing(fn ($record) => Number::currency($record['Price'], 'EUR', 'nl'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('Manufacturer.Title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Category.Title')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrains::route('/'),
            'create' => Pages\CreateTrain::route('/create'),
            'edit' => Pages\EditTrain::route('/{record}/edit'),
        ];
    }
}
