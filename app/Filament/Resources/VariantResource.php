<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VariantResource\Pages;
use App\Filament\Resources\VariantResource\RelationManagers;
use App\Models\Variant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariantResource extends Resource
{
    protected static ?string $model = Variant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')->required(),
                Forms\Components\Select::make('product_type')->options([
                    'باكيت' => 'باكيت',
                    'كرتونة' => 'كرتونة',
                    'قطعة' => 'قطعة',
                ])->required(),
                Forms\Components\TextInput::make('count_box_inPacket')->numeric(),
                Forms\Components\TextInput::make('count_single_InBox')->numeric(),
                Forms\Components\TextInput::make('packet_cost_price')->numeric(),
                Forms\Components\TextInput::make('packet_sell_price')->numeric(),
                Forms\Components\TextInput::make('box_cost_price')->numeric(),
                Forms\Components\TextInput::make('box_sell_price')->numeric(),
                Forms\Components\TextInput::make('single_cost_price')->numeric()->required(),
                Forms\Components\TextInput::make('single_sell_price')->numeric()->required(),
                Forms\Components\TextInput::make('packet_stock')->numeric(),
                Forms\Components\TextInput::make('box_stock')->numeric(),
                Forms\Components\TextInput::make('single_stock')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('product_type')->searchable(),
                Tables\Columns\TextColumn::make('single_cost_price')->label('Single Cost Price'),
                Tables\Columns\TextColumn::make('single_sell_price')->label('Single Sell Price'),
                Tables\Columns\TextColumn::make('packet_stock')->label('Packet Stock'),
                Tables\Columns\TextColumn::make('box_stock')->label('Box Stock'),
                Tables\Columns\TextColumn::make('single_stock')->label('Single Stock'),
            ])
            ->filters([])
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
            'index' => Pages\ListVariants::route('/'),
            'create' => Pages\CreateVariant::route('/create'),
            'edit' => Pages\EditVariant::route('/{record}/edit'),
        ];
    }
}
