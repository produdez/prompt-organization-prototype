<?php

namespace App\Filament\Resources\PromptBlockResource\RelationManagers;

use App\Filament\Resources\ChatBotResource;
use App\Models\ChatBot;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ChatBotsRelationManager extends RelationManager
{
    protected static string $relationship = 'chatBots';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions(
                [
                    Tables\Actions\ViewAction::make()
                        ->form([
                            TextInput::make('name'),
                            Textarea::make('description'),
                        ]),
                    Tables\Actions\Action::make('Edit')->url(fn (ChatBot $record): string => ChatBotResource::getUrl('edit', ['record' => $record])),
                ]
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function repeater(Repeater $repeater): Repeater
    {
        return $repeater->schema([
            TextInput::make('name')->required(),
            Select::make('role')
                ->options([
                    'member' => 'Member',
                    'administrator' => 'Administrator',
                    'owner' => 'Owner',
                ])
                ->required(),
        ])
            ->columns(2);
    }
}
