<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductsGeneral extends Component
{
    public function render()
    {
        return view('livewire.products-general')->extends('layout.side-menu')->section('subcontent');
    }
}
