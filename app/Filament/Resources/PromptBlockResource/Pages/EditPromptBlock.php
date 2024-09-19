<?php

namespace App\Filament\Resources\PromptBlockResource\Pages;

use App\Filament\Resources\PromptBlockResource;
use App\Models\PromptBlock;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\HtmlString;

class EditPromptBlock extends EditRecord
{
    protected static string $resource = PromptBlockResource::class;

    protected function getHeaderActions(): array
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

        return [
            Actions\DeleteAction::make()->modalDescription($getPromptBlockDeleteDescription),
        ];
    }
}
