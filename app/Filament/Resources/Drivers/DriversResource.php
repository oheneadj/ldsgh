<?php

namespace App\Filament\Resources\Drivers;

use BackedEnum;
use App\Models\Drivers;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\DriverProfile;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Drivers\Pages\ViewDriver;
use App\Filament\Resources\Drivers\Pages\ManageDrivers;

class DriversResource extends Resource
{
    protected static ?string $model = DriverProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Drivers';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Drivers')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Drivers')
            ->columns([
                TextColumn::make('Drivers')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageDrivers::route('/'),
            'view' => ViewDriver::route('/driver/{record}'),
        ];
    }
}
