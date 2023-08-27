<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
class Productdatatble extends LivewireDatatable
{
   
    
        public function columns()
    {
        return [
            NumberColumn::name('idProd')
                ->label('ID')
                ->sortBy('idProd'),
  
            Column::name('name')
                ->label('Nombre'),
            Column::name('price')
                ->label('Precio'),
            Column::name('img')
                ->view('products.img-div')->label('Imagen'),
                
               
            Column::name('description')
                ->label('Descripción'),
            
            Column::name('puntos')
                ->label('Puntos'),
                
                
               
               
               
              
            Column::callback(['idProd'], function ($idProd) {
                return view('products.table-actions', ['id' => $idProd]);
            })->unsortable()
        ];
    }
    public function rowClasses($row, $column)
{
    return 'flex justify-center'  ;
}
        
    
}
