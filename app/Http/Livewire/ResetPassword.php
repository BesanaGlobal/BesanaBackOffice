<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;


class ResetPassword extends Component
{
    public $newPass;
    public $confirPass;

    protected $listeners = ['update'];

    protected $rules = [
        'newPass'       => 'required',
        'confirPass'    => 'required|same:newPass',
    ];

    protected $messages = [
        'confirPass.same'        => 'las contraseñas no coinciden',

        'newPass.required'       => 'la contraseña es requerida',
        'confirPass.required'    => 'la contraseña es requerida',
    ];

    public function alertConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => 'Estás seguro?', 
                'text' => 'Presione aceptar si está seguro de cambiar su contraseña actual por la nueva ingresada, el proceso es irreversible.'
            ]);
    }

    public function update(){

        $datos              = $this->validate();
        $pass               = Hash::make($datos['newPass']);
        $affiliate          = User::where('idUser', Auth()->user()->idUser);

        $affiliate->update([
            'Password'      =>  $pass,
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Su contraseña ha sido actualizada!'
        ]);

    }

    public function render()
    {
        return view('livewire.reset-password')->extends('layout.side-menu')->section('subcontent');
    }
}
