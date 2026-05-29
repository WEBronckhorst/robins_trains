<?php

namespace App\Filament\Resources\TrainResource\Pages;

use App\Filament\Resources\TrainResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTrains extends ListRecords
{
    protected static string $resource = TrainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nieuwe trein'),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('Alle'),
        ];

        foreach (Category::query()->orderBy('Title')->get() as $category) {
            $tabs['category_'.$category->id] = Tab::make($category->Title)
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('category_id', $category->id));
        }

        return $tabs;
    }
}
