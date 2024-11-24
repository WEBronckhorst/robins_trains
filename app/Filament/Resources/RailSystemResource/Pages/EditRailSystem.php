<?php

namespace App\Filament\Resources\RailSystemResource\Pages;

use App\Filament\Resources\RailSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRailSystem extends EditRecord
{
    protected static string $resource = RailSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
