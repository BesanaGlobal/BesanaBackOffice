<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductsData extends Component
{
    public function render()
    {
        return view('livewire.products-data')->extends('layout.side-menu')->section('subcontent');
    }
}
