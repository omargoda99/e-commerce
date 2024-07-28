<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttributesResource\Pages;
use App\Filament\Resources\AttributesResource\RelationManagers;
use App\Models\Attributes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;

class AttributesResource extends Resource
{
    protected static ?string $model = Attributes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        return $form
        ->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('type')
                ->options([
                    'text' => 'Text',
                    'number' => 'Number',
                    'date' => 'Date',
                    // Add other types as needed
                ])->required(),
            Forms\Components\TextInput::make('suffix'),
            Forms\Components\Select::make('categories')
                ->relationship('categories', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('suffix')->sortable(),
            ])
            ->filters([
                Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter name')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->where('name', 'like', '%' . $data['name'] . '%');
                    })
                    ->label('Name'),
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
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttributes::route('/create'),
            'edit' => Pages\EditAttributes::route('/{record}/edit'),
        ];
    }
}
