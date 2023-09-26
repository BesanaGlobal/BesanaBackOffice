<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Sale;

class ShippingDataTable extends DataTableComponent
{
    // protected $model = Affiliate::class;
    public ?int $searchFilterDebounce = 50;
    public array $perPageAccepted = [5,10,25,50,100];

    public function configure(): void
    {
        $this->setPrimaryKey('idSale');
        $this->setDefaultSort('idSale', 'desc');
        
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "IdSale")
                ->sortable()
                ->searchable(),
            Column::make("Client Name", "WebNameClient")
                ->sortable(),
            Column::make("Phone", "WebWorkPhoneClient")
                ->sortable(),
            Column::make("Email", "WebEmailClient")
                ->sortable(),
            Column::make("Country", "WebCountryClient")
                ->sortable(),
            Column::make("State", "WebStateClient")
                ->sortable(),
            Column::make("City", "WebCityClient")
                ->sortable(),
            Column::make("Address", "WebAddressClient")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Shopping", "WebShop")
                ->sortable(),
            BooleanColumn::make("Sent", "Sent")
                ->sortable(),
            ButtonGroupColumn::make('Acciones')
                ->attributes(function($row){
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn($row) => 'ver')
                        ->location(fn($row) => route('shippingView', $row->IdSale))
                        ->attributes(function($row){
                            return [
                                'class' => 'px-3 py-2 btn bg-green-600 hover:btn h-12 w-32 bg-green-700 rounded-lg text-white opacity-100',
                            ];
                        })
                    ]),

        ];
    }


    public function builder(): Builder
    {
        
        return Sale::query()
        ->with('affiliate');
        // ->orderBy('IdSale', 'desc');
    }

}
