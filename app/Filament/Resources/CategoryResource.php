<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->nullable(),
                Forms\Components\TextInput::make('new_parent_id')
                    ->label('New Parent ID')
                    ->numeric()
                    ->nullable(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\FileUpload::make('image')->required(),
                Forms\Components\Toggle::make('isActive')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                
                Tables\Columns\TextColumn::make('parent.name')->label('Parent Category'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('isActive'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
