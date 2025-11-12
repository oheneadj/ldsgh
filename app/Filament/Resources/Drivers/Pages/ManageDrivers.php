<?php

namespace App\Filament\Resources\Drivers\Pages;

use App\Filament\Resources\Drivers\DriversResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDrivers extends ManageRecords
{
    protected static string $resource = DriversResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
