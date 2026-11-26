<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;

class ClientsRelationManager extends RelationManager
{
    protected static string $relationship = 'client'; // name of the relationship method in the parent model
    protected static ?string $title = 'Client';
    protected static ?string $recordTitleAttribute = 'name';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Section::make('Client Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('phone')
                        ->required()
                        ->tel()
                        ->maxLength(10)
                        ->unique(ignoreRecord: true)
                        ->numeric(),

                    Textarea::make('note')
                        ->maxLength(500),
                ]),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('created_at')
                ->dateTime('d.m.y | H:i')
                ->label('Created At')
                ->sortable()
                ->toggleable(),

            TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('phone')
                ->searchable()
                ->copyable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('total_orders')
                ->badge()
                ->colors([
                    'success' => fn($state) => $state === 1,
                    'primary' => fn($state) => $state >= 2 && $state <= 3,
                    'warning' => fn($state) => $state >= 4,
                ])
                ->sortable(),

            TextColumn::make('amount_spent')
                ->sortable()
                ->formatStateUsing(fn($state) => $state . ' DZD'),

            TextColumn::make('ip_address')
                ->copyable(),

            TextInputColumn::make('note')
                ->label('Note')
                ->placeholder('Add a note here')
                ->searchable()
                ->toggleable(),
        ])
            ->filters([])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
