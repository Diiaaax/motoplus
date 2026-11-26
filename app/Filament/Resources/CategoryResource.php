<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\CategoryResource\RelationManagers\ProductsRelationManager;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = 'Products';

    public static function getNavigationIcon(): string
{
    // Check if the current route is related to this resource
    return request()->routeIs('filament.admin.resources.categories.*')
        ? 'heroicon-s-squares-2x2' // Solid when active
        : 'heroicon-o-squares-2x2'; // Outline when inactive
}


    public static function form(Form $form): Form
    {
        return $form->schema([

            // Left section for Name & Slug
            Section::make('Category Info')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (?string $operation, ?string $state, Set $set) {
                            $set('slug', Str::slug($state));
                        }),

                    TextInput::make('slug')
                        ->label('Custom Slug')
                        ->helperText('Leave empty to auto-generate from name')
                        ->unique(ignoreRecord: true)
                        ->required(),
                ])
                ->columnSpan(2)
                ->columns(1),

            // Right section for image upload
            Group::make()
                ->schema([
                    Section::make('Category Image')
                        ->schema([
                            FileUpload::make('image_url')
                                ->label('Image')
                                ->image()
                                ->directory('categories')
                                ->imagePreviewHeight('150')
                                ->panelAspectRatio('1:1')
                                ->panelLayout('compact'),
                        ])
                        ->columns(1)
                        ->columnSpan(1),
                ]),

        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
