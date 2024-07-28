<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProviderResource\Pages;
use App\Filament\Resources\ProviderResource\RelationManagers;
use App\Models\Provider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProviderResource extends Resource
{
    protected static ?string $model = Provider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('fname')
                ->required()
                ->label('First Name'),
            Forms\Components\TextInput::make('lname')
                ->required()
                ->label('Last Name'),
            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('phone')
                ->required(),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ])
                ->required(),
            Forms\Components\Select::make('gender')
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                ])
                ->required(),
            Forms\Components\TextInput::make('wallet')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('points')
                ->required()
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('fname')->label('First Name')->searchable(),
            Tables\Columns\TextColumn::make('lname')->label('Last Name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('phone')->searchable(),
            Tables\Columns\TextColumn::make('status'),
            Tables\Columns\TextColumn::make('gender'),
            Tables\Columns\TextColumn::make('wallet'),
            Tables\Columns\TextColumn::make('points'),
        ])
            ->filters([
                Tables\Filters\Filter::make('full_name')
                    ->form([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->placeholder('Search by Full Name')
                    ])
                    ->query(function ($query, array $data) {
                        return $query->whereRaw('CONCAT(fname, " ", lname) LIKE ?', ["%{$data['full_name']}%"]);
                    }),
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
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
        ];
    }
}
