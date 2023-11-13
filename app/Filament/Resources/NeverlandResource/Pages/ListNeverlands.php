<?php

namespace App\Filament\Resources\NeverlandResource\Pages;

use App\Filament\Resources\NeverlandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNeverlands extends ListRecords
{
    protected static string $resource = NeverlandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
