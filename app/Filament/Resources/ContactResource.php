<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\DateRangeFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;


class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationGroup = 'Sales';

    public static function getNavigationIcon(): string
    {
        return request()->routeIs('filament.admin.resources.contacts.*')
            ? 'heroicon-s-chat-bubble-left-right'
            : 'heroicon-o-chat-bubble-left-right';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DateTimePicker::make('created_at')
                    ->label('Received At')
                    ->disabled() // Make it read-only
                    ->displayFormat('M d, Y H:i'),

                TextInput::make('name')
                    ->label('Name')
                    ->disabled(),

                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->disabled(),

                Toggle::make('status')
                    ->label('Feedback')
                    ->disabled()
                    ->inline(false)
                    ->onColor('success')
                    ->offColor('danger'),

                Textarea::make('message')
                    ->label('Message')
                    ->disabled()
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->label('Received At')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('status')
                    ->label('Feedback')
                    ->boolean()
                    ->trueIcon('heroicon-o-face-smile')
                    ->falseIcon('heroicon-o-face-frown')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Feedback Type')
                    ->options([
                        1 => 'Positive',
                        0 => 'Negative',
                    ]),

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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
