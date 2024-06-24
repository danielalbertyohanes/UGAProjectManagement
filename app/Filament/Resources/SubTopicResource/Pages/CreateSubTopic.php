<?php

namespace App\Filament\Resources\SubTopicResource\Pages;

use App\Filament\Resources\SubTopicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubTopic extends CreateRecord
{
    protected static string $resource = SubTopicResource::class;
}
