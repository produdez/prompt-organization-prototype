<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatBotResource\Pages;
use App\Filament\Resources\ChatBotResource\RelationManagers;
use App\Models\ChatBot;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChatBotResource extends Resource
{
    protected static ?string $model = ChatBot::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Chatbot Name'),
                        Forms\Components\Textarea::make('description')
                            ->label('Description'),
                    ]),

                Forms\Components\Section::make('Prompt Blocks')
                    ->schema([
                        Repeater::make('chatBotPrompts')
                            ->relationship('chatBotPrompts')
                            ->schema([
                                Select::make('prompt_block_id')
                                    ->relationship('promptBlock', 'name', modifyQueryUsing: fn (Builder $query) => $query->orderBy('id'))
                                    ->required()
                                    ->preload()
                                    ->label('Name'),
                                TextInput::make('prompt_block_id')->label('Prompt Id')->disabled(),
                                Select::make('prompt_block_id')
                                    ->relationship('promptBlock', 'content')
                                    ->required()
                                    ->selectablePlaceholder(false)
                                    ->label(label: 'Content')
                                    ->columnSpanFull()
                                    ->extraInputAttributes(['class' => 'text-wrap']),
                            ])
                            ->reorderable(true)
                            ->orderColumn('order_column')
                            ->columns(2)
                            ->itemLabel(
                                fn (array $state): ?string => isset($state['prompt_block_id']) && isset($state['order_column'])
                                    ? "Id: {$state['prompt_block_id']} Order: {$state['order_column']}"
                                    : 'New Prompt Relation'
                            ),
                    ]),
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
                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prompt_blocks_count')->counts('promptBlocks')->label('#Prompts'),
            ])
            ->filters([
                //
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
            RelationManagers\PromptBlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatBots::route('/'),
            'create' => Pages\CreateChatBot::route('/create'),
            'edit' => Pages\EditChatBot::route('/{record}/edit'),
        ];
    }
}
