<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ResetPassword extends Component
{
    public $currentPass;
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
        $this->dispatchBrowserEvent('swal:confirm');
    }

    public function SendMail($pass){
        $affiliate      = Affiliate::where('idAffiliated',auth()->user()->idAffiliated)->first();

        $datos          =   ['Email'=> $affiliate->Email,'Name'=> auth()->user()->userName, 'password'=> $pass];
        Mail::send('livewire.register.sendEmailPassword',$datos, function($message) use ($datos) {
            $message->to($datos['Email'], $datos['Name'])->subject('Nueva Contraseña-Besana');
        });
    }

    public function update($currentPass){
        $datos = $this->validate();

        if (password_verify($currentPass, Auth()->user()->Password)) {
            $pass               = Hash::make($datos['newPass']);
            $affiliate          = User::where('idUser', auth()->user()->idUser);
            $affiliate->update([
                'Password'      =>  $pass,
            ]);

            $this->SendMail($datos['newPass']);

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Su contraseña ha sido actualizada!'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',  
                'message' => 'Contraseña incorrecta!'
            ]);
        }


    }

    public function render()
    {
        return view('livewire.reset-password')->extends('layout.side-menu')->section('subcontent');
    }
}
