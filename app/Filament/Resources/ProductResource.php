<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Product Information')
                ->schema([
                    Select::make('brand_id')
                        ->relationship('brand', 'name')
                        ->searchable()
                        ->preload(),
                    TextInput::make('sku')
                        ->label('SKU')
                        ->unique(ignoreRecord: true),
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(?string $operation, ?string $state, Set $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->required(),
                    Select::make('vehicle_type')
                        ->options([
                            'motorcycle' => 'Motorcycle',
                            'scooter' => 'Scooter',
                            'spare_part' => 'Spare Part',
                            'battery' => 'Battery',
                            'charger' => 'Charger',
                            'accessory' => 'Accessory',
                        ])
                        ->default('motorcycle'),
                    Select::make('condition')
                        ->options([
                            'new' => 'New',
                            'used' => 'Used',
                            'refurbished' => 'Refurbished',
                        ])
                        ->default('new'),
                    TextInput::make('model_year')
                        ->numeric()
                        ->minValue(2020)
                        ->maxValue(2030),
                    RichEditor::make('description')
                        ->columnSpanFull(),
                ])->columns(3),

            Section::make('Pricing & Inventory')
                ->schema([
                    TextInput::make('price')
                        ->suffix('DZD')
                        ->numeric()
                        ->required(),
                    TextInput::make('compare_at_price')
                        ->suffix('DZD')
                        ->numeric()
                        ->nullable(),
                    TextInput::make('inventory')
                        ->numeric()
                        ->required()
                        ->default(0),
                    Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'discontinued' => 'Discontinued',
                            'pre_order' => 'Pre-Order',
                        ])
                        ->default('active'),
                    Toggle::make('is_featured')
                        ->label('Featured Product'),
                ])->columns(2),

            Section::make('Categories')
                ->schema([
                    Select::make('categories')
                        ->multiple()
                        ->relationship('categories', 'name')
                        ->preload()
                        ->searchable(),
                ]),

            Section::make('Media')
                ->schema([
                    Repeater::make('images')
                        ->relationship('images')
                        ->schema([
                            FileUpload::make('image_url')
                                ->label('Image')
                                ->image()
                                ->directory('products')
                                ->required(),
                        ])
                        ->minItems(0)
                        ->collapsible()
                        ->createItemButtonLabel('Add Image'),
                    TextInput::make('video_url')
                        ->url()
                        ->nullable()
                        ->columnSpanFull(),
                    FileUpload::make('manual_pdf')
                        ->label('Manual PDF')
                        ->directory('manuals')
                        ->acceptedFileTypes(['application/pdf']),
                ]),

            Section::make('Specifications')
                ->schema([
                    Repeater::make('specifications')
                        ->relationship('specifications')
                        ->schema([
                            TextInput::make('group')
                                ->label('Group')
                                ->placeholder('e.g. Motor, Battery, Charging')
                                ->required(),
                            TextInput::make('label')
                                ->placeholder('e.g. Power, Capacity, Time')
                                ->required(),
                            TextInput::make('value')
                                ->placeholder('e.g. 3000W, 72V, 4 hours')
                                ->required(),
                        ])
                        ->columns(3)
                        ->collapsible()
                        ->createItemButtonLabel('Add Specification'),
                ]),

            Section::make('Additional Info')
                ->schema([
                    TagsInput::make('tags')
                        ->placeholder('Add tags...')
                        ->separator(','),
                    TagsInput::make('highlights')
                        ->placeholder('Add highlights...')
                        ->separator(','),
                    TextInput::make('warranty_info')
                        ->maxLength(255),
                    TextInput::make('meta_title')
                        ->maxLength(255),
                    Textarea::make('meta_description')
                        ->maxLength(65535),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.0.image_url')
                    ->label('Image')
                    ->toggleable()
                    ->alignment('center'),
                TextColumn::make('brand.name')
                    ->badge()
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),
                TextColumn::make('title')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),
                TextColumn::make('vehicle_type')
                    ->badge()
                    ->toggleable()
                    ->alignment('center'),
                TextColumn::make('price')
                    ->suffix(' DZD')
                    ->sortable()
                    ->toggleable()
                    ->alignment('center'),
                TextColumn::make('inventory')
                    ->sortable()
                    ->toggleable()
                    ->alignment('center')
                    ->color(fn($state) => $state <= 5 ? 'danger' : 'success'),
                CheckboxColumn::make('is_featured')
                    ->label('Featured')
                    ->toggleable()
                    ->alignment('center'),
                ToggleColumn::make('status')
                    ->label('Active')
                    ->toggleable()
                    ->alignment('center'),
            ])
            ->filters([
                SelectFilter::make('brand_id')
                    ->relationship('brand', 'name'),
                SelectFilter::make('vehicle_type')
                    ->options([
                        'motorcycle' => 'Motorcycle',
                        'scooter' => 'Scooter',
                        'spare_part' => 'Spare Part',
                        'battery' => 'Battery',
                        'charger' => 'Charger',
                        'accessory' => 'Accessory',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'discontinued' => 'Discontinued',
                        'pre_order' => 'Pre-Order',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
