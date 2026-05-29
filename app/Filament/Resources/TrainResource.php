<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainResource\Pages;
use App\Models\Train;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use UnitEnum;

class TrainResource extends Resource
{
    protected static ?string $model = Train::class;

    protected static string|BackedEnum|null $navigationIcon = 'wi-train';

    protected static ?string $navigationLabel = 'Treinen';

    protected static ?string $modelLabel = 'trein';

    protected static ?string $pluralModelLabel = 'treinen';

    protected static string|UnitEnum|null $navigationGroup = 'Collectie';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'Title';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components(Train::getForm());
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components(Train::getInfolist());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('Image')
                    ->label('Foto')
                    ->square()
                    ->height(80),
                Tables\Columns\TextColumn::make('Title')
                    ->label('Titel')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('Manufacturer.Title')
                    ->label('Merk')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Category.Title')
                    ->label('Categorie')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('Scale')
                    ->label('Schaal')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('Country')
                    ->label('Land')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ?? '—')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('Decoder')
                    ->label('Decoder')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('epoch')
                    ->label('Tijdperk')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Quantity')
                    ->label('Aantal')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('Price')
                    ->label('Prijs')
                    ->money('EUR', locale: 'nl')
                    ->sortable(),
            ])
            ->defaultSort('Title')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Categorie')
                    ->relationship('Category', 'Title'),
                SelectFilter::make('manufacturer_id')
                    ->label('Merk')
                    ->relationship('Manufacturer', 'Title'),
                SelectFilter::make('rail_system_id')
                    ->label('Spoorsysteem')
                    ->relationship('RailSystem', 'Title'),
                SelectFilter::make('Scale')
                    ->label('Schaal')
                    ->options(fn (): array => Train::query()
                        ->whereNotNull('Scale')
                        ->distinct()
                        ->orderBy('Scale')
                        ->pluck('Scale', 'Scale')
                        ->all()),
                SelectFilter::make('Country')
                    ->label('Land')
                    ->options(Train::countryOptions()),
                SelectFilter::make('epoch')
                    ->label('Tijdperk')
                    ->options(Train::epochOptions()),
                TernaryFilter::make('Decoder')
                    ->label('Decoder'),
            ])
            ->filtersFormColumns(2)
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->recordUrl(fn (Train $record): string => static::getUrl('view', ['record' => $record]))
            ->actions([
                ViewAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrains::route('/'),
            'create' => Pages\CreateTrain::route('/create'),
            'view' => Pages\ViewTrain::route('/{record}'),
            'edit' => Pages\EditTrain::route('/{record}/edit'),
        ];
    }
}
