<?php

namespace App\Http\Livewire\Register;

use App\Models\Affiliate;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Register extends Component
{

    public $lenguaje = 'english';
    public $Name;
    public $LastName;
    public $DateBirth;
    public $selectCity;
    public $SSN = "";
    public $RFC = "";
    public $CURP = "";
    public $DPI = "";
    public $fechaingreso = null;
    public $invitedby;
    public $userName;
    public $Password;
    public $confirmPassword;

    public $SonAfiliate = [];
    public $asignarSocio = false;
    public $asignacionSocio;
    public $Workphone;
    public $WorkPhone;
    public $AlternativePhone;
    public $Email;
    public $confirmEmail;
    public $Address;
    public $Country;
    public $State;
    public $City;
    public $ZipCode;

    public $nohijos = false;
    public $terminos = false;

    public array $data;
    public $message;

    public $fhater;
    public $Latitude;
    public $Longitude;
    public $confirmation_code;
    public $password_confirmation;

    

    public function mount()
    {
        
        $this->invitedby = request('sponsor') ? request('sponsor') : "Besana";
        $this->lenguaje = 'spanish';
        $this->fechaingreso = date('Y-m-d');
        $this->selectCity = 1;
    }

    public function render()
    {
        return view('livewire.register.register')->extends('layout.login')->section('content');
    }


    protected $rules = [
        'SSN' => 'required_if:selectCity,1|unique:affiliates',
        'RFC' => 'required_if:selectCity,2|unique:affiliates',
        'CURP' => 'required_if:selectCity,2|unique:affiliates',
        'DPI' => 'required_if:selectCity,3|unique:affiliates',
        'fechaingreso' => 'required',
        'invitedby' => 'required',
        'Email' => 'required|unique:affiliates',
        'confirmEmail' => 'required|same:Email',
        'userName' => 'required|unique:users',
        'Name' => 'required|string',
        'LastName' => 'required|string',
        'AlternativePhone' => 'required',
        'WorkPhone' => 'required',
        'DateBirth' => 'required|string',
        'Address' => 'required|string',
        'Country' => 'required|string',
        'State' => 'required|string',
        'City' => 'required|string',
        'ZipCode' => 'required|string',
        'Password' => 'required',
        'password_confirmation' => 'required|same:Password',
    ];

    protected $messages = [
        'SSN.unique' => 'El SSN ya esta en uso',
        'RFC.unique' => 'El RFC ya esta en uso',
        'CURP.unique' => 'El CURP ya esta en uso',
        'DPI.unique' => 'El DPI ya esta en uso',
        'userName.unique' => 'El usuario ya esta en uso',
        'password_confirmation.same' => 'las contraseñas no coinciden',
        'Email.unique' => 'El Correo ya esta en uso',
        'confirmEmail.same' => 'Los correos no coinciden',

        'SSN.required_if' => 'El SSN es requerido',
        'RFC.required_if' => 'El RFC es requerido',
        'CURP.required_if' => 'El CURP es requerido',
        'DPI.required_if' => 'El DPI es requerido',
        'userName.required' => 'El usuario es requerido',
        'password_confirmation.required' => 'la contraseña es requerida',
        'Password.required' => 'la contraseña es requerida',
        'Email.required' => 'El Correo es requerido',
        'confirmEmail.required' => 'EL correo es requerido',
    ];

    public function create()
    {

        $confirmation_code = Str::random(25);
        $datos = $this->validate();
        $datos['confirmation_code'] = $confirmation_code;
        $mytime = Carbon::now();
        $null = 'nulll';
        $createdAt = Carbon::parse($datos['DateBirth']);
        $dateBirth = $createdAt->format('M d Y');
        $datecreated = $mytime->format('Y-m-d h:i');
        $website = 'https://www.besanaglobal.com/' . $datos['userName'];
        $pass = Hash::make($datos['Password']);

        $ssn = $datos['SSN'] ? $datos['SSN'] : null;
        $rfc = $datos['RFC'] ? $datos['RFC'] : null;
        $curp = $datos['CURP'] ? $datos['CURP'] : null;
        $dpi = $datos['DPI'] ? $datos['DPI'] : null;

        try {

            if ($datos['invitedby'] != 'Besana') {
                $user = User::where('userName', $datos['invitedby'])->first();
            } else {
                $user = User::where('userName', 'BesanaMaster')->first();
            }
            $fhater = $user->idAffiliated;
            $this->data = json_decode(json_encode(DB::select("CALL SpAffiliated (
                'NEW',
                0,
                '{$ssn}',
                '{$rfc}',
                '{$curp}',
                '{$dpi}',
                '{$datos['Name']}',
                '{$datos['LastName']}',
                {$datos['AlternativePhone']},
                {$datos['WorkPhone']},
                '{$datos['DateBirth']}',
                '{$datos['Email']}',
                null,
                '{$datos['Address']}',
                '{$datos['Country']}',
                '{$datos['State']}',
                '{$datos['City']}',
                {$datos['ZipCode']},
                {$datos['AlternativePhone']},
                '-12.34566',
                '12.34566',
                '{$datos['fechaingreso']}',
                null,
                '2023-01-23 03:40:31',
                1,
                '{$datos['userName']}',
                '{$pass}',
                '{$user->idAffiliated}',
                '{$website}',
                '{$confirmation_code}',
                3,
                {$fhater}
                )")), true);

            Mail::send('livewire.register.confirmation_code', $datos, function ($message) use ($datos) {
                $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
            });
            
             $this->dispatchBrowserEvent('noty', ['msg' => 'te hemos enviado un mensaje por correo, confirmalo!.']);
            
            // return redirect()->to('/login');
        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('noty', ['msg' => 'error de transaccion en base de datos: ' . $th]);
            return;
        }
    }

    public function verify($code)
    {
        $user = Affiliate::where('confirmation_code', $code)->first();


        if (!$user) {

            return redirect('/login');
        } else {
            $user->ConfirmedEmail = true;
            $user->confirmation_code = null;
            $user->save();
            return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
        }

        // $user->confirmed = true;
        // $user->confirmation_code = null;
        // $user->save();

    }

    // public function Editar(Affiliate $affiliate){

    //     dd($affiliate);
    // }
}
