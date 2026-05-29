<?php

namespace App\Filament\Resources\TrainResource\Pages;

use App\Filament\Resources\TrainResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrain extends ViewRecord
{
    protected static string $resource = TrainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Bewerken'),
            Actions\DeleteAction::make()->label('Verwijderen'),
        ];
    }
}
