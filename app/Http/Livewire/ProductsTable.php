<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
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
        ];
    }
}
