<?php

namespace App\Filament\Resources\RelationManagers;

use App\Filament\Resources\TrainResource;
use App\Support\FirstTrainConfetti;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TrainsRelationManager extends RelationManager
{
    protected static string $relationship = 'trains';

    protected static ?string $title = 'Treinen';

    protected static ?string $modelLabel = 'trein';

    protected static ?string $pluralModelLabel = 'treinen';

    public function form(Schema $schema): Schema
    {
        return TrainResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Title')
            ->columns([
                Tables\Columns\ImageColumn::make('Image')
                    ->label('Foto')
                    ->square()
                    ->height(50),
                Tables\Columns\TextColumn::make('Title')
                    ->label('Titel')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Scale')
                    ->label('Schaal'),
                Tables\Columns\TextColumn::make('Price')
                    ->label('Prijs')
                    ->money('EUR', locale: 'nl'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Nieuwe trein')
                    ->after(fn () => FirstTrainConfetti::celebrateIfEligible()),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
