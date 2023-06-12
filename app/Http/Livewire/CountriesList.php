<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CountriesList extends DataTableComponent
{
    

    public function columns(): array
    {
        return [
            Column::make('Nom', 'name')->searchable()->sortable(),
            Column::make('Prix WhatsApp', 'price_whatsapp')->searchable(),
            Column::make('Prix Facebook', 'price_facebook')->searchable(),
            Column::make('Prix Gmail', 'price_gmail')->searchable(),
            Column::make('Prix TikTok', 'price_tiktok')->searchable(),
            Column::make('Prix Telegram', 'price_telegram')->searchable(),
            Column::make('Acheter'),
        ];
    }
    
    public function query(): Builder
    {
        return Country::query();
    }

    public function rowView(): string
    {
        return 'livewire.countries-list';
    }
    
  
}
