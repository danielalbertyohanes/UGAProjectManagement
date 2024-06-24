<?php

namespace App\Filament\Resources\SubTopicResource\Pages;

use App\Filament\Resources\SubTopicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubTopics extends ListRecords
{
    protected static string $resource = SubTopicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
