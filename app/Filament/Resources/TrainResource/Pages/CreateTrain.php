<?php

namespace App\Filament\Resources\TrainResource\Pages;

use App\Filament\Resources\TrainResource;
use App\Support\FirstTrainConfetti;
use Filament\Resources\Pages\CreateRecord;

class CreateTrain extends CreateRecord
{
    protected static string $resource = TrainResource::class;

    protected function afterCreate(): void
    {
        parent::afterCreate();

        FirstTrainConfetti::celebrateIfEligible();
    }
}
