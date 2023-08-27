<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
class MyShops extends Component
{
    public $data=[];
    public $datestart;
    public $dateend;
    public $mensaje;

    public function render()
    {
        return view('livewire.my-shops')->extends('layout.side-menu')
        ->section('subcontent');
    }

    public function query()
    {
       
        if (is_null($this->datestart)||is_null($this->dateend)) {
            $this->mensaje='Fecha invalidas!!';
            return;
          } else {
            try {
            $this->mensaje=null;

                $idAfiliado=Auth()->user()->idAffiliated;
                $this->data=DB::select('CALL sp_compras(?,?,?)', array(
                $this->datestart,
                $this->dateend,
                $idAfiliado // Convertir a nulo si es una cadena vacía
                    ));
            
          
            } catch (\Throwable $th) {
            dd($th);
            }
        }
    }
}
