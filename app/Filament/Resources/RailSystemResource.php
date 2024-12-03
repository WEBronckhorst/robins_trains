<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RailSystemResource\Pages;
use App\Filament\Resources\RailSystemResource\RelationManagers;
use App\Models\RailSystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RailSystemResource extends Resource
{
    protected static ?string $model = RailSystem::class;

    protected static ?string $navigationIcon = 'gameicon-rail-road';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema( RailSystem::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Title'),
                Tables\Columns\TextColumn::make('Description')
                    ->limit(50)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
