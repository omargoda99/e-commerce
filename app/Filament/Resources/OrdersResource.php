<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Orders;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('customer_id')
                ->relationship('customer', 'fname')
                ->required(),
            Forms\Components\TextInput::make('total')
                ->required()
                ->numeric(),
            Forms\Components\Select::make('status')
                ->options([
                    'new' => 'New',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),
            Forms\Components\Select::make('payment_method')
                ->options([
                    'cod' => 'COD',
                    'stripe' => 'Stripe',
                ])
                ->required(),
            Forms\Components\Select::make('payment_status')
                ->options([
                    'pending' => 'Pending',
                    'failed' => 'Failed',
                    'completed' => 'Completed',
                ])
                ->required(),
            Forms\Components\TextInput::make('currency')
                ->default('INR')
                ->required(),
            Forms\Components\TextInput::make('shipping_method')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('customer.fname')->label('User')->searchable(),
            Tables\Columns\TextColumn::make('total')->label('Grand Total'),
            Tables\Columns\TextColumn::make('payment_method')->label('Payment Method'),
            Tables\Columns\TextColumn::make('payment_status')->label('Payment Status'),
            Tables\Columns\SelectColumn::make('status')->label('Status')->options([
                'new' => 'New',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled',
            ]),
            Tables\Columns\TextColumn::make('currency')->label('Currency'),
            Tables\Columns\TextColumn::make('shipping_method')->label('Shipping Method'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'new' => 'New',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled',
            ]),
        ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }
}
