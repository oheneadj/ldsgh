<?php

namespace App\Filament\Resources\Drivers;

use BackedEnum;
use App\Models\User;
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
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Drivers\Pages\ViewDriver;
use App\Filament\Resources\Drivers\Pages\ManageDrivers;

class DriversResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationLabel = 'Drivers';
    protected static ?string $recordTitleAttribute = 'Drivers';

    protected static ?string $modelLabel = 'Driver';

    protected static ?string $pluralModelLabel = 'Drivers';

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('role', 'driver');
}

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('Driver Name')
                    ->required()
                    ->placeholder('Eg. Nii Mensah')
                    ->maxLength(255),
                    \Filament\Forms\Components\FileUpload::make('profile_photo_path')
                        ->label('Profile Photo')
                        ->image()
                        ->directory('driver-profile-photos')
                        ->preserveFilenames()
                        ->nullable(),

                    \Filament\Forms\Components\TextInput::make('license_number')
                        ->label('License Number')
                        ->disabled(),
                    \Filament\Forms\Components\FileUpload::make('license_image'),
                    TextInput::make('email')
                        ->email()
                        ->nullable()
                        ->placeholder('eg. name@example.com'),

                    TextInput::make('phone')
                        ->tel()
                        ->required()
                        ->maxLength(20)
                        ->placeholder('+233 ...'),

                    \Filament\Forms\Components\Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading('No drivers found')
            ->recordTitleAttribute('Drivers')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                    TextColumn::make('role')
                    ->badge(),
                    TextColumn::make('phone'),
                    TextColumn::make('driver_profile.license_number')
                    ->badge()
                    ->color('gray')
                    ->label('License Number'),
                    
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
