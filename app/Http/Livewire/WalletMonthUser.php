<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\WalletMonth;
use Livewire\Component;

class WalletMonthUser extends Component
{
    public $data;
    public $dataPay;
    public $date;
    public $mount;

    public function mount($id)
    {
        $this->data = Affiliate::where('idAffiliated', $id)
        ->with('user')
        ->get();
        
        $this->dataPay = WalletMonth::where('id_user', $this->data[0]->user->idUser )
        ->where('fechaInicio', '>=', date('Y-m-01'))
        ->get();

        $this->date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.wallet-month-user')->extends('layout.side-menu')->section('subcontent');
    }


    public function CreatePay(){

        $sqlCreate = WalletMonth::create([
            'id_user'       => $this->data[0]->user->idUser,
            'total'         => $this->mount,
            'fechaInicio'   => $this->date,
            'FechaFin'      => Null,
            'estado'        => 'Pendiente',
            'tipopago'      => Null,
        ]);

        $this->reset('mount');
        $this->dispatchBrowserEvent('noty', ['msg' => 'Asignación de pago!']);

    }



}
