<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;


class ShippingView extends Component
{
    public $data;
 
    public function mount(Sale $id){

        $this->data = Sale::where('idSale', $id->idSale)
        ->with(['affiliate','detailSales.product'])
        ->get();
       
    }

    public function updateSend(){
        $sale  = Sale::where('idSale',$this->data[0]->idSale);
      
        $sale->update([
            'Sent'   =>  1,
        ]);

        $this->dispatchBrowserEvent('noty', ['msg' => 'Cambiando estatus a Enviado!']);

    }

    public function render()
    {
        return view('livewire.shippingView')->extends('layout.side-menu')->section('subcontent');
    }

   
    
}
