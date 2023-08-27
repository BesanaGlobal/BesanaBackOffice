<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AfiliatesDatatable extends LivewireDatatable 
{
    public $model = Affiliate::class;
    public function columns()
    {
        return [
            NumberColumn::name('idAffiliated')
                ->label('ID')
                ->sortBy('idAffiliated'),
  
            Column::name('Name')
                ->label('Nombre'),
  
            Column::name('Email')
                ->label('Correo'),
                Column::name('AlternativePhone')
                ->label('Telefono'),
                
            DateColumn::name('CreatedAt')
                ->label('Fecha de Ingreso')
                ->sortBy('CreatedAt'),
                
               
               
               
              
            Column::callback(['idAffiliated'], function ($idAffiliated) {
                return view('afiliados.table-actions', ['id' => $idAffiliated]);
            })->unsortable()
        ];
    }
            public function rowClasses($row, $column)
        {
            return 'flex justify-center'  ;
        }


    
}
