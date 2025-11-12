<?php

namespace App\Filament\Pages;

use BackedEnum;
use App\Models\Setting;
use Filament\Pages\Page;
use App\Models\WebsitePage;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;

/**
 * @property-read Schema $form
 */

class Settings extends Page
{
    protected string $view = 'filament.pages.settings';

  

protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';


    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
         $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'My Delivery Service'),
            'support_email' => Setting::getValue('support_email', 'support@example.com'),
            'support_phone' => Setting::getValue('support_phone', '+1 555-123-4567'),

            'base_fare' => Setting::getValue('base_fare', 100),
            'per_km_rate' => Setting::getValue('per_km_rate', 25),
            'per_kg_rate' => Setting::getValue('per_kg_rate', 10),
            'commission_rate' => Setting::getValue('commission_rate', 10),
        ]);
    }

 public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    // --- Business Info Section ---
                    Section::make('Company Information')
                        ->description('Basic contact information used across your platform.')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('company_name')
                                        ->label('Company Name')
                                        ->placeholder('e.g. SwiftRider Logistics')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('support_email')
                                        ->label('Support Email')
                                        ->placeholder('e.g. support@swiftrider.com')
                                        ->email()
                                        ->required(),
                                         TextInput::make('support_phone')
                                ->label('Support Phone')
                                ->placeholder('+1 555-123-4567')
                                ->maxLength(50),
                                ]),
                           
                        ])
                        ->collapsible(),

                    // --- Pricing Section ---
                    Section::make('Pricing Settings')
                        ->description('Control how your fares are calculated for rides and deliveries.')
                        ->schema([
                            Grid::make(4)
                                ->schema([
                                    TextInput::make('base_fare')
                                        ->label('Base Fare')
                                        ->numeric()
                                        ->suffix('GHS')
                                         ->suffixIconColor('primary')
                                        ->placeholder('e.g. 100')
                                        ->required()
                                        ->minValue(0),

                                    TextInput::make('per_km_rate')
                                        ->label('Per Kilometer Rate')
                                        ->numeric()
                                        ->suffix('GHS / km')
                                        ->placeholder('e.g. 25')
                                        ->required()
                                        ->minValue(0),

                                    TextInput::make('per_kg_rate')
                                        ->label('Per Kilogram Rate')
                                        ->numeric()
                                        ->suffix('GHS / kg')
                                        ->placeholder('e.g. 10')
                                        ->minValue(0),

                                    TextInput::make('commission_rate')
                                        ->label('Commission Rate')
                                        ->numeric()
                                        ->suffix('%')
                                        ->placeholder('e.g. 10')
                                        ->minValue(0)
                                        ->maxValue(100),
                                ]),
                        ])
                        ->collapsible(),

                    // --- Notes Section ---
                    Section::make('Additional Notes')
                        ->description('Optional administrative notes about fare logic or special cases.')
                        ->schema([
                            RichEditor::make('notes')
                                ->placeholder('e.g. Extra charge applies for long-distance deliveries or night-time rides.')
                                
                                ->columnSpanFull(),
                        ])
                        ->collapsed(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save Changes')
                                ->submit('save')
                                ->color('primary')
                                ->icon('heroicon-o-check-circle')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            $type = is_numeric($value) ? 'number' : 'string';
            Setting::setValue($key, $value, $type);
        }

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }
    
    public function getRecord(): ?Setting
    {
        return Setting::first();
    }

}
