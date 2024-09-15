<?php

namespace App\Filament\Resources\PromptBlockResource\Pages;

use App\Filament\Resources\PromptBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromptBlocks extends ListRecords
{
    protected static string $resource = PromptBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
