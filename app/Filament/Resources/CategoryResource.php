<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('category_name')
                    ->required()
                    ->placeholder('Enter category name')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')->unique()

                
                    ->placeholder('Slug generated automatically'),
                Radio::make('status')->options([
                    '1' => 'Active',
                    '0' => 'Blocked'
                ])->default('1')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_name'),
                TextColumn::make('slug'),
                TextColumn::make('status')->formatStateUsing(function ($state) {
                    if ($state == '1') {
                        return 'Active';
                    } else {
                        return 'Blocked';
                    }
                })->badge()
                    ->color(function ($state) {
                        if ($state == '1') {
                            return 'success';
                        } else {
                            return 'danger';
                        }
                    })
            ])
            ->defaultSort('id', 'desc') // Set default sorting by ID in descending order
            ->filters([
                //
            ])
            ->actions([
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
