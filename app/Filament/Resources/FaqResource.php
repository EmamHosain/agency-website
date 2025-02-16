<?php

namespace App\Filament\Resources;

use App\Models\Faq;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FaqResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FaqResource\RelationManagers;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question')
                    ->placeholder('Enter faq question')
                    ->required(),
                TextInput::make('order')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                RichEditor::make('answer')
                    ->placeholder('Enter faq answer')
                    ->required(),
                Radio::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Blocked'
                    ])
                    ->default('1')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->limit(30),
                TextColumn::make('answer')->limit(50),
                TextColumn::make('order'),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state == 1 ? 'Active' : 'Blocked')
                    ->badge()
                    ->color(fn($state) => $state == 1 ? 'success' : 'danger'),
            ])
            ->filters([

                SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Blocked',
                    ])
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
