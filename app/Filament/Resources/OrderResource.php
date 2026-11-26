<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Commune;
use App\Models\Wilaya;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Sales';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('wilaya_id')
                ->label('Wilaya')
                ->options(Wilaya::pluck('wilaya_name_fr', 'wilaya_code'))
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) => $set('commune_id', null))
                ->required(),

            Select::make('commune_id')
                ->label('Commune')
                ->options(fn(callable $get) => Commune::where('wilaya_code', $get('wilaya_id'))->pluck('commune_name_fr', 'id'))
                ->reactive()
                ->required(),

            Select::make('client_id')
                ->label('Client')
                ->relationship(name: 'client', titleAttribute: 'name')
                ->required()
                ->createOptionForm([
                    Section::make('Client Information')
                        ->schema([
                            TextInput::make('name')->required()->maxLength(255),
                            TextInput::make('phone')->required()->tel()->maxLength(10)->unique(ignoreRecord: true)->numeric(),
                            Textarea::make('note')->maxLength(500),
                        ]),
                ]),

            Select::make('product_id')
                ->label('Product')
                ->relationship(name: 'product', titleAttribute: 'title')
                ->required(),

            TextInput::make('quantity')
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->required(),

            Select::make('delivery_method')
                ->label('Delivery Method')
                ->options([
                    'Door' => 'Door',
                    'StopDesk' => 'StopDesk',
                    'store_pickup' => 'Store Pickup',
                ])
                ->required(),

            Textarea::make('notes')
                ->label('Order Notes')
                ->maxLength(1000),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d.m.y | H:i')
                    ->label('Date')
                    ->sortable()
                    ->toggleable()
                    ->alignCenter(),

                TextColumn::make('id')
                    ->label('Order #')
                    ->copyable()
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => '#M' . str_pad($state, 4, '0', STR_PAD_LEFT))
                    ->alignCenter(),

                TextColumn::make('client.name')
                    ->label('Client')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('client.phone')
                    ->label('Phone')
                    ->copyable()
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('product.title')
                    ->label('Product')
                    ->sortable()
                    ->toggleable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('quantity')
                    ->label('Qty')
                    ->sortable()
                    ->toggleable()
                    ->alignCenter(),

                TextColumn::make('total_price')
                    ->label('Total')
                    ->formatStateUsing(fn($state) => number_format($state, 2) . ' DZD')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('delivery_method')
                    ->badge()
                    ->colors([
                        'success' => fn($state) => $state === 'Door',
                        'info' => fn($state) => $state === 'StopDesk',
                        'warning' => fn($state) => $state === 'store_pickup',
                    ])
                    ->alignCenter(),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Processing' => 'Processing',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'Canceled' => 'Canceled',
                        'Returned' => 'Returned',
                    ])
                    ->sortable()
                    ->toggleable()
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Processing' => 'Processing',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'Canceled' => 'Canceled',
                        'Returned' => 'Returned',
                    ]),
                SelectFilter::make('delivery_method')
                    ->label('Delivery Method')
                    ->options([
                        'Door' => 'Door Delivery',
                        'StopDesk' => 'StopDesk',
                        'store_pickup' => 'Store Pickup',
                    ])
                    ->attribute('delivery_method'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\OrderResource\RelationManagers\ClientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
