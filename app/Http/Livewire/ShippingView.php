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

    public function render()
    {
        return view('livewire.shippingView')->extends('layout.side-menu')->section('subcontent');
    }

   
    
}
