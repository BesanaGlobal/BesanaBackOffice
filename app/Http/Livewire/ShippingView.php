<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;


class ShippingView extends Component
{
    public $data;
 
   
    public function mount(Affiliate $id){
        $this->data = Affiliate::where('idAffiliated', 2)
        ->with(['sales.detailSales.product'])
        ->get();

        // dd($this->data);
    }

    public function render()
    {
        return view('livewire.shippingView')->extends('layout.side-menu')->section('subcontent');
    }

   
    
}
