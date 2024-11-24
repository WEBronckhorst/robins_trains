<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RailSystem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Title',
        'Description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
    public static function getForm(): array
    {
        return [
            TextInput::make('Title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            RichEditor::make('Description')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }
}
