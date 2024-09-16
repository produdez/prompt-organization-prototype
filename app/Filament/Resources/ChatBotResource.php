<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatBotResource\Pages;
use App\Filament\Resources\ChatBotResource\RelationManagers;
use App\Models\ChatBot;
use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

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
                            ->label('Description')
                            ->dehydrated(fn ($state) => filled($state)),
                    ]),
                Forms\Components\Section::make('Prompt Blocks')
                    ->schema([
                        Repeater::make('chatBotPrompts')
                            ->relationship()
                            ->schema([
                                Select::make('prompt_block_id')
                                    ->relationship('promptBlock', 'name')
                                    ->required()
                                    ->label('Name'),
                            ])->reorderable(true)
                            ->orderColumn('order_column')
                            ->columns(2)
                            ->itemLabel(
                                fn (array $state): ?string =>
                                isset($state['prompt_block_id']) && isset($state['order_column'])
                                    ? "Prompt Id: {$state['prompt_block_id']}, order: {$state['order_column']}"
                                    : null
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
