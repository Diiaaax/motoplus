<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Models\Commune;
use App\Models\Wilaya;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Resources\RelationManagers\RelationManager;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';
    protected static ?string $recordTitleAttribute = 'id';
    protected static ?string $title = 'Orders';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Select Wilaya
            Select::make('wilaya_code')
                ->label('Wilaya')
                ->options(Wilaya::pluck('wilaya_name_fr', 'wilaya_code'))
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) => $set('commune_id', null))
                ->required(),

            // Select Commune
            Select::make('commune_id')
                ->label('Commune')
                ->options(fn(callable $get) => Commune::where('wilaya_code', $get('wilaya_code'))->pluck('commune_name_fr', 'id'))
                ->required()
                ->reactive(),

            // Select Product
            Select::make('product_id')
                ->label('Product')
                ->relationship(name: 'product', titleAttribute: 'title')
                ->required(),

            // Quantity
            TextInput::make('quantity')
                ->numeric()
                ->minValue(1)
                ->default(1)
                ->required(),

            // Delivery Method
            Select::make('delivery_method')
                ->label('Delivery Method')
                ->options([
                    'Door' => 'Door',
                    'StopDesk' => 'StopDesk',
                ])
                ->required(),

            // IP Address (optional)
            TextInput::make('ip_address')
                ->label('IP Address')
                ->maxLength(45)
                ->nullable(),

            // Optional Note
            Textarea::make('note')
                ->label('Note')
                ->maxLength(500)
                ->nullable(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime('d.m.y | H:i')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('id')
                ->label('Order ID')
                ->copyable()
                ->sortable()
                ->formatStateUsing(fn($state) => '#C' . str_pad($state, 4, '0', STR_PAD_LEFT))
                ->alignCenter(),

            TextColumn::make('commune.wilaya.wilaya_name_fr')
                ->label('Wilaya')
                ->sortable()
                ->searchable()
                ->alignCenter(),

            TextColumn::make('commune.commune_name_fr')
                ->label('Commune')
                ->sortable()
                ->searchable()
                ->alignCenter(),

            TextColumn::make('product.title')
                ->label('Product')
                ->sortable()
                ->searchable()
                ->alignCenter(),

            TextColumn::make('quantity')
                ->label('Quantity')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('ip_address')
                ->label('IP Address')
                ->copyable()
                ->searchable()
                ->alignCenter(),

            TextInputColumn::make('note')
                ->label('Note')
                ->placeholder('Add a note here')
                ->alignCenter(),

            TextColumn::make('delivery_method')
                ->label('Method')
                ->badge()
                ->colors([
                    'success' => fn($state) => $state === 'Door',
                    'info' => fn($state) => $state === 'StopDesk',
                ])
                ->alignCenter(),

            TextColumn::make('product.price')
                ->label('Product Price')
                ->formatStateUsing(fn($state) => $state . ' DA')
                ->sortable()
                ->alignCenter(),

            TextColumn::make('delivery_price')
                ->label('Delivery Price')
                ->getStateUsing(fn($record) => $record->calculateDeliveryPrice() ?? 0) // gets raw value
                ->formatStateUsing(fn($state) => $state ? $state . ' DA' : 'N/A')     // formats it
                ->sortable()
                ->alignCenter(),



            TextColumn::make('total_price')
                ->label('Total Price')
                ->formatStateUsing(fn($state) => $state . ' DA')
                ->sortable()
                ->alignCenter(),

            IconColumn::make('status_icon')
                ->label('')
                ->state(fn($record) => $record->status ?? 'Unknown')
                ->icon(fn(?string $state): string => match ($state) {
                    'Pending' => 'heroicon-o-clock',
                    'Confirmed' => 'heroicon-o-check-circle',
                    'Canceled' => 'heroicon-o-x-circle',
                    'Shipped' => 'heroicon-o-truck',
                    'Delivered' => 'heroicon-o-cube',
                    'Returned' => 'heroicon-o-arrow-uturn-left',
                    default => 'heroicon-o-question-mark-circle',
                })
                ->color(fn(?string $state): string => match ($state) {
                    'Pending' => 'warning',
                    'Confirmed' => 'success',
                    'Canceled' => 'danger',
                    'Shipped' => 'info',
                    'Delivered' => 'success',
                    'Returned' => 'danger',
                    default => 'gray',
                })
                ->tooltip(fn(?string $state): string => $state ?? 'Unknown')
                ->alignCenter(),

            SelectColumn::make('status')
                ->label('Status')
                ->options([
                    'Pending' => '⏳ Pending',
                    'Confirmed' => '✅ Confirmed',
                    'Canceled' => '❌ Canceled',
                    'Shipped' => '🚚 Shipped',
                    'Delivered' => '📬 Delivered',
                    'Returned' => '↩️ Returned',
                ])
                ->sortable()
                ->searchable()
                ->alignCenter(),
        ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
