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
use Filament\Schemas\Components\Section;

class Train extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'manufacturer_id',
        'rail_system_id',
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
            Section::make()
                ->schema([
                    TextInput::make('Title')
                        ->columnSpan(2)
                        ->name('Titel')
                        ->required()
                        ->maxLength(255),

                    Select::make('category_id')
                        ->name('Categorie')
                        ->relationship(name: 'Category', titleAttribute: 'Title')
                        ->createOptionForm(Category::getForm())
                        ->editOptionForm(Category::getForm()),
                    Select::make('manufacturer_id')
                        ->name('Merk')
                        ->relationship(name: 'Manufacturer', titleAttribute: 'Title')
                        ->createOptionForm(Manufacturer::getForm())
                        ->editOptionForm(Manufacturer::getForm()),

                    Select::make('rail_system_id')
                        ->name('Spoor systeem')
                        ->relationship(name: 'RailSystem', titleAttribute: 'Title')
                        ->createOptionForm(RailSystem::getForm())
                        ->editOptionForm(RailSystem::getForm()),
                    Select::make('Epoch')
                        ->name('Tijdperk')
                        ->options([
                            'I',
                            'II',
                            'III',
                            'IV',
                            'V',
                            'VI',
                            'VII'
                        ]),
                ])
                ->columns(3),

            RichEditor::make('Description')
                ->name('Beschrijving')
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


            Section::make()
                ->schema([
                    FileUpload::make('Image')
                        ->name('Afbeelding')
                        ->image(),
                    TextInput::make('Scale')
                        ->name('Schaal')
                        ->default('N (1:160)')
                        ->required(),
                    Select::make('country')
                        ->label('Land')
                        ->options([
                            'DE' => 'Duitsland',
                            'AT' => 'Oostenrijk',
                            'BE' => 'België',
                            'BG' => 'Bulgarije',
                            'CY' => 'Cyprus',
                            'CZ' => 'Tsjechië',
                            'DK' => 'Denemarken',
                            'EE' => 'Estland',
                            'FI' => 'Finland',
                            'FR' => 'Frankrijk',
                            'GR' => 'Griekenland',
                            'HU' => 'Hongarije',
                            'IE' => 'Ierland',
                            'IT' => 'Italië',
                            'LV' => 'Letland',
                            'LT' => 'Litouwen',
                            'LU' => 'Luxemburg',
                            'MT' => 'Malta',
                            'NL' => 'Nederland',
                            'PL' => 'Polen',
                            'PT' => 'Portugal',
                            'RO' => 'Roemenië',
                            'SK' => 'Slowakije',
                            'SI' => 'Slovenië',
                            'ES' => 'Spanje',
                            'SE' => 'Zweden',
                        ])
                        ->default('DE'), // Duitsland is standaard geselecteerd

                    TextInput::make('Company')
                        ->name('Bedrijf')

                        ->maxLength(255),
                    TextInput::make('CompanyNumber')
                        ->name('Bedrijfsnummer'),
                    TextInput::make('Quantity')
                        ->name('Aantal')
                        ->default(1)
                        ->numeric(),
                    ColorPicker::make('Color')
                        ->name('Kleur'),

                    DatePicker::make('PurchasedDate')
                        ->name('Aankoop datum'),

                    TextInput::make('Packaging')
                        ->name('Verpakking')
                        ->maxLength(255),
                    TextInput::make('Price')
                        ->name('Prijs')
                        ->prefix('€')
                        ->numeric()
                        ->maxLength(255),
                    TextInput::make('Condition')
                        ->name('Staat')
                        ->maxLength(255),

                    TextInput::make('Address')
                        ->name('Lok adres')
                        ->maxLength(255),
                    Toggle::make('Decoder'),
                    RichEditor::make('ShortDescription')
                        ->columnSpan(2)
                        ->name('Bestelnummer producent'),
                ])
                ->columns(2),



        ];
    }
}
