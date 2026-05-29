<?php

namespace App\Models;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Train extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'manufacturer_id',
        'rail_system_id',
        'epoch',
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
        'Price',
        'Condition',
        'Address',
    ];

    protected $casts = [
        'id' => 'integer',
        'Decoder' => 'boolean',
        'PurchasedDate' => 'date',
        'Price' => 'decimal:2',
        'epoch' => 'string',
    ];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function Manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function RailSystem(): BelongsTo
    {
        return $this->belongsTo(RailSystem::class);
    }

    public static function countryOptions(): array
    {
        return [
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
        ];
    }

    public static function epochOptions(): array
    {
        return [
            'I' => 'I',
            'II' => 'II',
            'III' => 'III',
            'IV' => 'IV',
            'V' => 'V',
            'VI' => 'VI',
            'VII' => 'VII',
        ];
    }

    public static function getForm(): array
    {
        return [
            Tabs::make('Trein')
                ->tabs([
                    Tab::make('Algemeen')
                        ->schema([
                            Section::make()
                                ->schema([
                                    TextInput::make('Title')
                                        ->label('Titel')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpan(2),
                                    Select::make('category_id')
                                        ->label('Categorie')
                                        ->relationship(name: 'Category', titleAttribute: 'Title')
                                        ->createOptionForm(Category::getForm())
                                        ->editOptionForm(Category::getForm())
                                        ->required(),
                                    Select::make('manufacturer_id')
                                        ->label('Merk')
                                        ->relationship(name: 'Manufacturer', titleAttribute: 'Title')
                                        ->createOptionForm(Manufacturer::getForm())
                                        ->editOptionForm(Manufacturer::getForm())
                                        ->required(),
                                    Select::make('rail_system_id')
                                        ->label('Spoorsysteem')
                                        ->relationship(name: 'RailSystem', titleAttribute: 'Title')
                                        ->createOptionForm(RailSystem::getForm())
                                        ->editOptionForm(RailSystem::getForm())
                                        ->required(),
                                    Select::make('epoch')
                                        ->label('Tijdperk')
                                        ->options(self::epochOptions())
                                        ->default('IV'),
                                    TextInput::make('Scale')
                                        ->label('Schaal')
                                        ->default('N (1:160)')
                                        ->required(),
                                    Select::make('Country')
                                        ->label('Land')
                                        ->options(self::countryOptions())
                                        ->default('NL')
                                        ->searchable(),
                                ])
                                ->columns(3),
                        ]),
                    Tab::make('Rollend materieel')
                        ->schema([
                            Section::make()
                                ->schema([
                                    TextInput::make('Company')
                                        ->label('Bedrijf')
                                        ->maxLength(255),
                                    TextInput::make('CompanyNumber')
                                        ->label('Bedrijfsnummer'),
                                    ColorPicker::make('Color')
                                        ->label('Kleur'),
                                    Toggle::make('Decoder')
                                        ->label('Decoder'),
                                    TextInput::make('Address')
                                        ->label('Lokadres')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                        ]),
                    Tab::make('Aankoop & staat')
                        ->schema([
                            Section::make()
                                ->schema([
                                    TextInput::make('Quantity')
                                        ->label('Aantal')
                                        ->default(1)
                                        ->numeric()
                                        ->required(),
                                    TextInput::make('Price')
                                        ->label('Prijs')
                                        ->prefix('€')
                                        ->numeric(),
                                    DatePicker::make('PurchasedDate')
                                        ->label('Aankoopdatum'),
                                    TextInput::make('Packaging')
                                        ->label('Verpakking')
                                        ->maxLength(255),
                                    TextInput::make('Condition')
                                        ->label('Staat')
                                        ->maxLength(255),
                                ])
                                ->columns(2),
                        ]),
                    Tab::make('Media & notities')
                        ->schema([
                            Section::make()
                                ->schema([
                                    FileUpload::make('Image')
                                        ->label('Afbeelding')
                                        ->image()
                                        ->columnSpanFull(),
                                    RichEditor::make('Description')
                                        ->label('Beschrijving')
                                        ->columnSpanFull()
                                        ->toolbarButtons([
                                            'blockquote',
                                            'bold',
                                            'bulletList',
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
                                    TextInput::make('ShortDescription')
                                        ->label('Bestelnummer producent')
                                        ->maxLength(255)
                                        ->columnSpanFull(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ];
    }

    public static function getInfolist(): array
    {
        return [
            Section::make('Identificatie')
                ->schema([
                    TextEntry::make('Title')
                        ->label('Titel')
                        ->weight('bold')
                        ->size('lg'),
                    TextEntry::make('Category.Title')
                        ->label('Categorie'),
                    TextEntry::make('Manufacturer.Title')
                        ->label('Merk'),
                    TextEntry::make('RailSystem.Title')
                        ->label('Spoorsysteem'),
                    TextEntry::make('epoch')
                        ->label('Tijdperk')
                        ->placeholder('—'),
                    TextEntry::make('Company')
                        ->label('Bedrijf')
                        ->placeholder('—'),
                    TextEntry::make('CompanyNumber')
                        ->label('Bedrijfsnummer')
                        ->placeholder('—'),
                ])
                ->columns(2),
            Section::make('Technisch')
                ->schema([
                    TextEntry::make('Scale')
                        ->label('Schaal'),
                    TextEntry::make('Country')
                        ->label('Land')
                        ->formatStateUsing(fn (?string $state): string => self::countryOptions()[$state] ?? $state ?? '—'),
                    ColorEntry::make('Color')
                        ->label('Kleur'),
                    IconEntry::make('Decoder')
                        ->label('Decoder')
                        ->boolean()
                        ->trueIcon('heroicon-o-check-circle')
                        ->falseIcon('heroicon-o-x-circle')
                        ->trueColor('success')
                        ->falseColor('gray'),
                    TextEntry::make('Address')
                        ->label('Lokadres')
                        ->placeholder('—'),
                ])
                ->columns(2),
            Section::make('Aankoop & staat')
                ->schema([
                    TextEntry::make('PurchasedDate')
                        ->label('Aankoopdatum')
                        ->date('d-m-Y')
                        ->placeholder('—'),
                    TextEntry::make('Packaging')
                        ->label('Verpakking')
                        ->placeholder('—'),
                    TextEntry::make('Condition')
                        ->label('Staat')
                        ->placeholder('—'),
                    TextEntry::make('Price')
                        ->label('Prijs')
                        ->money('EUR', locale: 'nl')
                        ->placeholder('—'),
                    TextEntry::make('Quantity')
                        ->label('Aantal'),
                ])
                ->columns(2),
            Section::make('Afbeelding & beschrijving')
                ->schema([
                    ImageEntry::make('Image')
                        ->label('Afbeelding')
                        ->columnSpanFull(),
                    TextEntry::make('Description')
                        ->label('Beschrijving')
                        ->html()
                        ->placeholder('—')
                        ->columnSpanFull(),
                    TextEntry::make('ShortDescription')
                        ->label('Bestelnummer producent')
                        ->placeholder('—')
                        ->columnSpanFull(),
                ]),
        ];
    }
}
