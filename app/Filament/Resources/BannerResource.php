<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;


class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\FileUpload::make('image')->required(),
                Forms\Components\TextInput::make('discount')->numeric()->required(),
                Forms\Components\TextInput::make('btnText'),
                Forms\Components\TextInput::make('btnURL'),
                Forms\Components\Toggle::make('isHome')->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('image')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('discount')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('btnText')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('btnURL')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('isHome')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable()->searchable(),
            ])
            ->filters([
                Filter::make('title')
                    ->form([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Enter title')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->where('title', 'like', '%' . $data['title'] . '%');
                    })
                    ->label('Title'),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
