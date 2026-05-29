<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManufacturerResource\Pages;
use App\Filament\Resources\RelationManagers\TrainsRelationManager;
use App\Models\Manufacturer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ManufacturerResource extends Resource
{
    protected static ?string $model = Manufacturer::class;

    protected static string|BackedEnum|null $navigationIcon = 'gameicon-factory';

    protected static ?string $navigationLabel = 'Merken';

    protected static ?string $modelLabel = 'merk';

    protected static ?string $pluralModelLabel = 'merken';

    protected static string|UnitEnum|null $navigationGroup = 'Instellingen';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(Manufacturer::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('Logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('Title')
                    ->label('Titel')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('trains_count')
                    ->label('Treinen')
                    ->counts('trains')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Description')
                    ->label('Beschrijving')
                    ->getStateUsing(fn ($record) => strip_tags($record['Description'] ?? ''))
                    ->limit(50),
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
            TrainsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManufacturers::route('/'),
            'create' => Pages\CreateManufacturer::route('/create'),
            'edit' => Pages\EditManufacturer::route('/{record}/edit'),
        ];
    }
}
