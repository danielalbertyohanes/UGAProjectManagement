<?php

namespace App\Filament\Resources\PPTResource\Pages;

use App\Filament\Resources\PPTResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPPT extends EditRecord
{
    protected static string $resource = PPTResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
