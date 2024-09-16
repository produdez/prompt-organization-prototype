<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromptBlockResource\Pages;
use App\Filament\Resources\PromptBlockResource\RelationManagers;
use App\Models\PromptBlock;
use Doctrine\DBAL\Schema\View;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class PromptBlockResource extends Resource
{
    protected static ?string $model = PromptBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Prompt Block Name'),
                Forms\Components\Textarea::make('content')
                    ->label('Content')
                    ->dehydrated(fn ($state) => filled($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('name'),
                        Forms\Components\Textarea::make('content'),
                    ])

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
            RelationManagers\ChatBotsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromptBlocks::route('/'),
            'create' => Pages\CreatePromptBlock::route('/create'),
            'edit' => Pages\EditPromptBlock::route('/{record}/edit'),
        ];
    }
}
