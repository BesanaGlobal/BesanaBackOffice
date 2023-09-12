<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;


class MyShops extends Component
{
    public $data = [];
    public $datestart;
    public $dateend;
    public $mensaje;

    public function render()
    {
        return view('livewire.my-shops')->extends('layout.side-menu')->section('subcontent');
    }

    public function query()
    {

        if ($this->datestart == null && $this->dateend == null) {
            $this->mensaje = 'Fecha invalidas!!';
            $this->data = [];
            return;
        } else {
            try {
                $idAfiliado = Auth()->user()->idAffiliated;
                $this->mensaje = null;
                $this->data = Sale::where('idAffiliated', $idAfiliado)
                ->where('webShop', 'office')
                ->whereHas('detailSales', function ( $query) {
                    if ($this->datestart && $this->dateend) {
                        $query->whereDate('datetimeb', '>=', $this->datestart);
                        $query->whereDate('datetimeb', '<=', $this->dateend);
                    }
                    if ($this->datestart) {
                        $query->whereDate('datetimeb', '>=', $this->datestart);
                    }
                    if ($this->dateend) {
                        $query->whereDate('datetimeb', '<=', $this->dateend);
                    }
                })
                ->with('detailSales.product')
                ->get();

                if(count($this->data) == 0){
                    $this->mensaje = 'Sin registros en fechas seleccionada!!';
                    return;
                }
            } catch (\Throwable $th) {
                // dd($th);
            }
        }
    }
}
