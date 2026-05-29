<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RailSystemResource\Pages;
use App\Models\RailSystem;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class RailSystemResource extends Resource
{
    protected static ?string $model = RailSystem::class;

    protected static string|BackedEnum|null $navigationIcon = 'gameicon-rail-road';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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
                Tables\Columns\TextColumn::make('Title'),
                Tables\Columns\TextColumn::make('Description')
                    ->getStateUsing(fn ($record) => strip_tags($record['Description']))
                    ->limit(50),
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
            'index' => Pages\ListRailSystems::route('/'),
            'create' => Pages\CreateRailSystem::route('/create'),
            'edit' => Pages\EditRailSystem::route('/{record}/edit'),
        ];
    }
}
