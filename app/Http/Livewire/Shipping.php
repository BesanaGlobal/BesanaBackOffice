<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;

class Shipping extends Component
{
    public $data = [];

    public function mount(){
        $this->data = Affiliate::with('sales.detailSales.product')->limit(10)->get();
        
    }

    public function render()
    {
        return view('livewire.shipping')->extends('layout.side-menu')->section('subcontent');
    }

    public function query()
    {
        try {
            

            return;
        } catch (\Throwable $th) {
            // dd($th);
        }
    }
}
