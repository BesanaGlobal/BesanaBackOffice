<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\Product;

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("IdProd", "idProd")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Img", "img")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("IdLine", "idLine")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Active", "active")
                ->sortable(),
            Column::make("Puntos", "puntos")
                ->sortable(),
            Column::make("Sku", "sku")
                ->sortable(),
            Column::make("Directions", "directions")
                ->sortable(),
            Column::make("Key ingredients", "key_ingredients")
                ->sortable(),
            Column::make("Ingredients", "ingredients")
                ->sortable(),
            Column::make("PuntosWebsite", "puntosWebsite")
                ->sortable(),
            ButtonGroupColumn::make('Acciones')
                ->attributes(function($row){
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View')
                        ->title(fn($row) => 'Editar')
                        ->location(fn($row) => '#')
                        ->attributes(function($row){
                            return [
                                'class' => 'px-3 py-2 btn bg-green-600 hover:btn h-12 w-32 bg-green-700 rounded-lg text-white opacity-100',
                            ];
                        }),
                    LinkColumn::make('View')
                        ->title(fn($row) => 'Detalles')
                        ->location(fn($row) => '#')
                        ->attributes(function($row){
                            return [
                                'class' => 'px-3 py-2 btn bg-blue-700 hover:btn h-12 w-32 bg-blue-800 rounded-lg text-white opacity-100',
                            ];
                        })
                    ]),
        ];
    }
}
