<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\ServiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceResource\RelationManagers;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->placeholder('Enter title'),
                TextInput::make('icon_class')->nullable()->placeholder('Enter icon class'),

                Textarea::make('short_desc')->label('Short Description')
                    ->placeholder('Enter short description')
                    ->nullable()->columnSpan(2),


                RichEditor::make('description')
                    ->nullable()
                    ->placeholder('Enter Description')
                    ->columnSpanFull(),

                Radio::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Block',
                    ])->required()->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('short_desc')->label('Short Description')->limit(50),
                
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state == 1 ? 'Active' : 'Blocked')
                    ->badge()
                    ->color(fn($state) => $state == 1 ? 'success' : 'danger'),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id', 'desc') // Set default sorting by ID in descending order
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
