<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RailSystemResource\Pages;
use App\Filament\Resources\RelationManagers\TrainsRelationManager;
use App\Models\RailSystem;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class RailSystemResource extends Resource
{
    protected static ?string $model = RailSystem::class;

    protected static string|BackedEnum|null $navigationIcon = 'gameicon-rail-road';

    protected static ?string $navigationLabel = 'Spoorsystemen';

    protected static ?string $modelLabel = 'spoorsysteem';

    protected static ?string $pluralModelLabel = 'spoorsystemen';

    protected static string|UnitEnum|null $navigationGroup = 'Instellingen';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(RailSystem::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListRailSystems::route('/'),
            'create' => Pages\CreateRailSystem::route('/create'),
            'edit' => Pages\EditRailSystem::route('/{record}/edit'),
        ];
    }
}
