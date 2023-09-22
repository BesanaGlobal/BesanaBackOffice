<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Affiliate;
use App\Models\Sale;

class ShippingDataTable extends DataTableComponent
{
    // protected $model = Affiliate::class;
    public ?int $searchFilterDebounce = 50;
    public array $perPageAccepted = [5,10,25,50,100];



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        
    }

    public function columns(): array
    {
        return [
            Column::make("IdAffiliated", "idAffiliated")
                ->sortable()
                ->searchable(),
            Column::make("Name", "Name")
                ->sortable(),
            Column::make("LastName", "LastName")
                ->sortable(),
            // Column::make("ShopDate", "sales.datetimeb")
            //     ->sortable(),
            ButtonGroupColumn::make('Acciones')
                ->attributes(function($row){
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn($row) => 'ver')
                        ->location(fn($row) => route('shippingView', $row->idAffiliated))
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
        
        return Affiliate::query()
        ->with('sales');
    }



}
