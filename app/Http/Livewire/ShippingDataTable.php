<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\Affiliate;

class ShippingDataTable extends DataTableComponent
{
    protected $model = Affiliate::class;
    public ?int $searchFilterDebounce = 50;
    public array $perPageAccepted = [5,10,25,50,100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultReorderSort('Name', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("IdAffiliated", "idAffiliated")
                ->sortable()
                ->searchable(),
            Column::make("SSN", "SSN")
                ->sortable(),
            Column::make("RFC", "RFC")
                ->sortable(),
            Column::make("CURP", "CURP")
                ->sortable(),
            Column::make("DPI", "DPI")
                ->sortable(),
            Column::make("Name", "Name")
                ->sortable(),
            Column::make("LastName", "LastName")
                ->sortable(),
            Column::make("AlternativePhone", "AlternativePhone")
                ->sortable(),
            Column::make("WorkPhone", "WorkPhone")
                ->sortable(),
            Column::make("DateBirth", "DateBirth")
                ->sortable(),
            Column::make("Email", "Email")
                ->sortable(),
            Column::make("ConfirmedEmail", "confirmedEmail")
                ->sortable(),
            Column::make("Address", "Address")
                ->sortable(),
            Column::make("Country", "Country")
                ->sortable(),
            Column::make("State", "State")
                ->sortable(),
            Column::make("City", "City")
                ->sortable(),
            Column::make("ZipCode", "ZipCode")
                ->sortable(),
            Column::make("Phone", "Phone")
                ->sortable(),
            Column::make("Latitude", "Latitude")
                ->sortable(),
            Column::make("Longitude", "Longitude")
                ->sortable(),
            Column::make("CreatedAt", "CreatedAt")
                ->sortable(),
            Column::make("ModifiedAt", "ModifiedAt")
                ->sortable(),
            Column::make("FirstBuy", "firstBuy")
                ->sortable(),
            Column::make("StatusAff", "StatusAff")
                ->sortable(),
            Column::make("Confirmation code", "confirmation_code")
                ->sortable(),
            Column::make("IdRank", "idRank")
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
                        ->location(fn($row) => route('login', $row))
                        ->attributes(function($row){
                            return [
                                'class' => 'px-3 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-white'
                            ];
                        })
                    ]),









            
            
        ];
    }
}
