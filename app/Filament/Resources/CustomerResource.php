<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form //to create
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fname')->required(),
                Forms\Components\TextInput::make('lname')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->required(),
                Forms\Components\Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->required(),
                Forms\Components\TextInput::make('wallet')->required(),
                Forms\Components\TextInput::make('points')->required(),
                Forms\Components\Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ]),
                Forms\Components\TextInput::make('password')->required(),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fname'),
                Tables\Columns\TextColumn::make('lname'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('password'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('wallet'),
                Tables\Columns\TextColumn::make('points'),
            ])
            ->filters([
                Filter::make('full_name')
                    ->form([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->placeholder('Enter full name')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->whereRaw("CONCAT(fname, ' ', lname) LIKE ?", ['%' . $data['full_name'] . '%']);
                    })
                    ->label('Full Name'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
