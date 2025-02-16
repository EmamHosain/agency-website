<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberResource\RelationManagers;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->placeholder('Enter member name')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('designation')
                    ->columnSpanFull()
                    ->nullable(),

                TextInput::make('fb_url')
                    ->label('Facebook URL')
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),

                TextInput::make('inst_url')
                    ->label('Instagram URL')
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),

                TextInput::make('twi_url')
                    ->label('Twiiter URL')
                    ->url()
                    ->suffixIcon('heroicon-m-globe-alt'),

                Select::make('status')->options([
                    '1' => 'Active',
                    '0' => 'Block'
                ])
                ->required()
                ->default('1'),

                FileUpload::make('image')
                    ->image()
                    ->maxWidth(150)
                    ->required()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name'),
                TextColumn::make('designation'),
                TextColumn::make('fb_url')->label('Facebook URL')->limit(20),
                TextColumn::make('inst_url')->label('Instagram URL')->limit(20),
                TextColumn::make('twi_url')->label('Twiiter URL')->limit(20),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state == 1 ? 'Active' : 'Blocked')
                    ->badge()
                    ->color(fn($state) => $state == 1 ? 'success' : 'danger'),

            ])
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
