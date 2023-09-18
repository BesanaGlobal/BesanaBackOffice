<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;


class Shipping extends Component
{
 
    public function render()
    {
        return view('livewire.shipping')->extends('layout.side-menu')->section('subcontent');
    }

    
}
