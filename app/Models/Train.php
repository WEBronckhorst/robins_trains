<?php

namespace App\Models;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\text;
use function Symfony\Component\Translation\t;
use Filament\Forms\Components\Section;
class Train extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CategoryId',
        'ManufacturerId',
        'RailSystemId',
        'Title',
        'Quantity',
        'Description',
        'Image',
        'Scale',
        'Country',
        'Company',
        'CompanyNumber',
        'Color',
        'Decoder',
        'ShortDescription',
        'PurchasedDate',
        'Packaging',
        'Condition',
        'PurchasedFor',
        'Address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Decoder' => 'boolean',
        'PurchasedDate' => 'date',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
    public function RailSystem()
    {
        return $this->belongsTo(RailSystem::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('Title')
                ->required()
                -> maxLength(255),

            Select::make('Category')
                ->relationship(name: 'Category', titleAttribute: 'Title')
                ->createOptionForm(Category::getForm())
                ->editOptionForm(Category::getForm()),
            Select::make('Manufacturer')
                ->relationship(name: 'Manufacturer', titleAttribute: 'Title')
                ->createOptionForm(Manufacturer::getForm())
                ->editOptionForm(Manufacturer::getForm()),
            Select::make('RailSystem')
                ->relationship(name: 'RailSystem', titleAttribute: 'Title')
                ->createOptionForm(RailSystem::getForm())
                ->editOptionForm(RailSystem::getForm()),

            RichEditor::make('Description')
                ->columnSpanFull()
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ]),


            Section::make('Details')
                ->schema([
                    FileUpload::make('Image')
                        ->image(),
                    TextInput::make('Scale')
                        ->numeric()
                        ->required(),
                    TextInput::make('Country')
                        ->required()
                        -> maxLength(255),
                    TextInput::make('Company')
                        ->required()
                        -> maxLength(255),
                    TextInput::make('CompanyNumber')
                        ->required()
                        -> numeric(),
                    ColorPicker::make('Color')
                        ->required(),

                    Textarea::make('ShortDescription')
                        ->required(),
                    DatePicker::make('PurchasedDate')
                        ->required()
                        ->default(now()),

                    TextInput::make('Packaging')
                        ->required()
                        -> maxLength(255),
                    TextInput::make('Condition')
                        ->required()
                        -> maxLength(255),
                    TextInput::make('PurchasedFor')
                        ->required()
                        -> maxLength(255),
                    TextInput::make('Address')
                        ->required()
                        -> maxLength(255),
                    Toggle::make('Decoder')
                        ->required()
                ])
                ->columns(2),



        ];
    }
}
