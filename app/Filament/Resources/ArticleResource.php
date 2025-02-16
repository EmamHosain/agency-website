<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->options(fn() => Category::where('status', 1)->pluck('category_name', 'id'))
                    ->nullable(),

                TextInput::make('title')
                    ->required()
                    ->placeholder('Enter title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')->placeholder('Slug genarated automatically'),

                TextInput::make('author_name')
                    ->label('Author')
                    ->placeholder('Enter author name')
                    ->maxLength(255)
                    ->nullable(),

                RichEditor::make('content')
                    ->label('Content')
                    ->nullable()->columnSpanFull()
                ,

                CheckboxList::make('tags')
                    ->label('Tags')
                    ->options(fn() => \App\Models\Tag::pluck('tag_name', 'id')->toArray())
                    ->relationship('tags', 'tag_name')
                    ->bulkToggleable()
                    ->columns(2),




                FileUpload::make('article_image')
                    ->label('Article Image')
                    ->image()
                    ->directory('articles')
                    ->nullable(),

                Toggle::make('status')
                    ->label('Active')
                    ->default(true)->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('article_image'),
                TextColumn::make('title')->limit(20)->searchable(),
                TextColumn::make('slug')->limit(20),
                TextColumn::make('author_name')->formatStateUsing(function ($state) {
                    if (empty($state)) {
                        return 'Unknown';
                    } else {
                        return $state;
                    }
                }),

                
                BadgeColumn::make('tags')
                    ->label('Tags')
                    ->colors([
                        'primary',
                    ])
                    ->getStateUsing(fn($record) => $record->tags->pluck('tag_name')->toArray()),

                TextColumn::make('status')->formatStateUsing(fn($state) => $state == '1' ? 'Active' : 'Blocked')
                    ->badge()->color(fn($state) => $state == '1' ? 'success' : 'danger'),


            ])
            ->defaultSort('id', 'desc') // Set default sorting by ID in descending order
            ->filters([

                SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(fn() => Category::where('status', 1)->pluck('category_name', 'id')),
            ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
