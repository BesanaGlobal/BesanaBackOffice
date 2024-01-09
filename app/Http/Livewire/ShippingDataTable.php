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
            Column::make("ID", "idSale")
                ->sortable()
                ->searchable(),
            Column::make(__('Client Name'), "WebNameClient")
                ->sortable()
                ->searchable(),
            Column::make(__('Phone'), "WebWorkPhoneClient")
                ->sortable()
                ->searchable(),
            Column::make(__('Email'), "WebEmailClient")
                ->sortable()
                ->searchable(),
            // Column::make("Country", "WebCountryClient")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("State", "WebStateClient")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("City", "WebCityClient")
            //     ->sortable()
            //     ->searchable(),
            // Column::make("Address", "WebAddressClient")
            //     ->sortable()
            //     ->searchable(),
            Column::make(__('Price'), "price")
                ->sortable()
                ->searchable(),
            Column::make(__('Shopping'), "WebShop")
                ->sortable()
                ->searchable(),
            BooleanColumn::make(__('Sent'), "Sent")
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make(__('Actions'))
                ->attributes(function($row){
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn($row) => __('Show'))
                        ->location(fn($row) => route('shippingView', $row->idSale))
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
    }

}
