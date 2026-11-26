<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Product Info')
                ->schema([

                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (?string $operation, ?string $state, Set $set) {
                            $set('slug', Str::slug($state));
                        }),

                    TextInput::make('price')
                        ->suffix(' DZD')
                        ->numeric()
                        ->required(),

                    TextInput::make('compare_at_price')
                        ->suffix(' DZD')
                        ->numeric()
                        ->nullable(),

                    Select::make('categories')
                        ->multiple()
                        ->relationship('categories', 'name')
                        ->preload()
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')->required(),
                            FileUpload::make('image_url')
                                ->label('Collection Image')
                                ->image()
                                ->directory('categories'),
                        ]),

                    TextInput::make('inventory')
                        ->numeric()
                        ->required(),

                    RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),

                ])->columnSpan(2)->columns(2),

            Group::make()->schema([

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image_url')
                            ->label('Images')
                            ->image()
                            ->required()
                            ->directory('products'),
                    ])->columnSpan(1),

                Section::make('SEO')
                    ->schema([
                        TagsInput::make('tags')
                            ->placeholder('Add tags...')
                            ->suggestions(['smartphone', 'laptop', 'gaming', 'new'])
                            ->separator(',')
                            ->reorderable()
                            ->color('info'),

                        TextInput::make('slug')
                            ->label('Custom Slug')
                            ->helperText('Leave empty to auto-generate from title')
                            ->unique(ignoreRecord: true)
                            ->required(),
                    ])->columnSpan(1),
            ]),

        ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),

                TextColumn::make('title')
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),

                TextColumn::make('price')
                    ->suffix(' DZD')
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),

                TextColumn::make('inventory')
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),

                TextColumn::make('categories.name')
                    ->badge()
                    ->label('Category')
                    ->toggleable()
                    ->searchable()
                    ->alignment('center'),

                CheckboxColumn::make('is_featured')
                    ->label('Featured')
                    ->toggleable()
                    ->alignment('center'),

                ToggleColumn::make('status')
                    ->label('Active')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->toggleable()
                    ->alignment('center'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Attach Products')
                    ->form([
                        Select::make('products')
                            ->label('Select Products')
                            ->options(function ($livewire) {
                                $category = $livewire->getOwnerRecord();
                                $attachedIds = $category->products()->pluck('products.id')->toArray();
                                return \App\Models\Product::query()
                                    ->whereNotIn('id', $attachedIds)
                                    ->pluck('title', 'id');
                            })
                            ->multiple()
                            ->searchable()
                            ->required(),
                    ])
                    ->modalActions([
                        \Filament\Actions\Action::make('attach')
                            ->label('Attach')
                            ->submit('attach'),
                    ])
                    ->action(function ($data) {
                        $productIds = $data['products'] ?? [];
                        if (!empty($productIds)) {
                            $this->getOwnerRecord()->products()->attach($productIds);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
