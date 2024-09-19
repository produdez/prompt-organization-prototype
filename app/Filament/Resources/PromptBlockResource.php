<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromptBlockResource\Pages;
use App\Filament\Resources\PromptBlockResource\RelationManagers;
use App\Models\PromptBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class PromptBlockResource extends Resource
{
    /**
     * Class PromptBlockResource
     *
     * This class handles the resources related to prompt blocks within the application.
     *
     * Note:
     * The promptMapping order is not re-ordered after deleting a promptBlock.
     * This decision is based on the fact that the order of promptMapping is unaffected by the deletion,
     * making the additional logic for re-ordering unnecessary.
     */
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
        $getPromptBlockDeleteDescription = function (PromptBlock $block) {
            return new HtmlString(sprintf(
                'Danger - %d bot%s using this prompt<br>%s<br>%s',
                $block->chatBots()->count(),
                $block->chatBots()->count() === 1 ? '' : 's',
                $block->chatBots()->pluck('name')->implode('<br>'), // Implode with <br> for HTML newlines
                '<br><strong class="italic text-base text-red-500"> Make sure this is intended !!!</strong>'
            ));
        };

        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('chat_bots_count')->counts('chatBots')->label('#Usage'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalDescription($getPromptBlockDeleteDescription),
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('name'),
                        Forms\Components\Textarea::make('content'),
                    ]),

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
