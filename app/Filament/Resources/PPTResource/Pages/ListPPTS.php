<?php

namespace App\Filament\Resources\PPTResource\Pages;

use App\Filament\Resources\PPTResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPPTS extends ListRecords
{
    protected static string $resource = PPTResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
