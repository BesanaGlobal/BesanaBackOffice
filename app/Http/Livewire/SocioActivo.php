<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use App\Models\RelSponsor;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;
use Illuminate\Validation\Rule;

class SocioActivo extends Component
{
    public $lenguaje = 'english';
    public $Name;
    public $LastName;
    public $DateBirth;
    public $selectCity;
    public $SSN;
    public $RFC;
    public $CURP;
    public $DPI;
    public $IP;
    public $fechaingreso;
    public $invitedby;
    public $userName;
    public $Password;
    public $confirmPassword;
    public $SonAfiliate;
    public $asignarSocio;
    public $asignacionSocio;
    public $AreaCodeWorkPhone;
    public $WorkPhone;
    public $AreaCodeAlternativePhone;
    public $AlternativePhone;
    public $Email;
    public $confirmEmail;
    public $Address;
    public $selectedCountry;
    public $selectedState;
    public $selectedCity;
    public $bankName;
    public $selectBankAccount;
    public $bankAccount;
    public $routingNumber;
    public $typeAccount;
    public $Authorization;
    public $ZipCode;
    public $fhater;
    public $Latitude;
    public $Longitude;
    public $confirmation_code;
    public $password_confirmation;

    public $nohijos     = false;
    public $terminos    = false;

    public $message;   
    public array $data;
    public $AreaCode  = ['+1','+52','+507','+502'];
    
    public $Countries  = [
        'EE UU' => [
            'Alabama',
            'Alaska',
            'Arizona',
            'Arkansas',
            'California',
            'Colorado',
            'Connecticut',
            'Delaware',
            'Florida',
            'Georgia',
            'Hawaii',
            'Idaho',
            'Illinois',
            'Indiana',
            'Iowa',
            'Kansas',
            'Kentucky',
            'Luisiana',
            'Maine',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Misisipi',
            'Misuri',
            'Montana',
            'Nebraska',
            'Nevada',
            'New Hampshire',
            'Nueva Jersey',
            'Nuevo Mexico',
            'Nueva York',
            'Carolina del Norte',
            'Carolina del Sur',
            'Dakota del Norte',
            'Dakota del Sur',
            'Ohio',
            'Oklahoma',
            'Oregon',
            'Pensilvania',
            'Rhode Island',
            'Carolina del Sur',
            'Tennessee',
            'Texas',
            'Utah',
            'Vermont',
            'Virginia',
            'Washington',
            'West Virginia',
            'Wisconsin',
            'Wyoming'
        ],
         'Mexico' => [
            'Aguascalientes',
            'Baja California',
            'Baja California Sur',
            'Campeche',
            'Chiapas',
            'Chihuahua',
            'Coahuila',
            'Colima',
            'Durango',
            'Guanajuato',
            'Guerrero',
            'Hidalgo',
            'Jalisco',
            'México',
            'Michoacán',
            'Morelos',
            'Nayarit',
            'Nuevo León',
            'Oaxaca',
            'Puebla',
            'Querétaro',
            'Quintana Roo',
            'San Luis Potosí',
            'Sinaloa',
            'Sonora',
            'Tabasco',
            'Tamaulipas',
            'Tlaxcala',
            'Veracruz',
            'Yucatán',
            'Zacatecas'
         ],
         'Guatemala' => [
            'Alta Verapaz',
            'Baja Verapaz',
            'Chimaltenango',
            'Chiquimula',
            'El Progreso',
            'Escuintla',
            'Guatemala',
            'Huehuetenango',
            'Izabal',
            'Jalapa',
            'Jutiapa',
            'Petén',
            'Quetzaltenango',
            'Quiché',
            'Retalhuleu',
            'Sacatepequez',
            'San Marcos',
            'Santa Rosa',
            'Sololá',
            'Suchitepéquez',
            'Totonicapán',
            'Zacapa',
         ],
         'Panamá' => [
            'Bocas del Toro',
            'Chiriquí',
            'Coclé',
            'Colón',
            'Darién',
            'Herrera',
            'Los Santos',
            'Panamá',
            'Veraguas',
            'Guna Yala',
            'Emberá-Wounaan',
            'Ngöbe-Buglé',
            'Kuna de Wargandí',
            'Kuna de Madungandí',
         ]
    ];

    public $States;
    public $Cities;

    public function updatedSelectedCountry($country)
    {
        if (!is_null($country)) {
           $this->States = $this->Countries[$country];
        }
        
    }

    public function mount(String $id='besana')
    {
        $this->fechaingreso = date('Y-m-d');
        $this->selectCity   = 0;
        $this->invitedby    = $id;
        $this->lenguaje     = 'spanish';

    }

    public function render()
    {
        $idafiliado         = Auth()->user()->idAffiliated;

        $this->SonAfiliate  = DB::table('relsponsor')
        ->join('affiliates', 'relsponsor.idAffiliatedChild', '=', 'affiliates.idAffiliated')
        ->join('users', 'affiliates.idAffiliated', '=', 'users.idAffiliated')
        ->where('relsponsor.idAffiliatedParent', $idafiliado)
        ->select([
            'relsponsor.idRel',
            'relsponsor.idAffiliatedParent',
            'relsponsor.idAffiliatedChild',
            'affiliates.idAffiliated',
            'affiliates.Name',
            'users.userName'
        ])
        ->get();

        $this->invitedby    = Auth()->user()->userName;

        return view('livewire.socio-activo')->extends('layout.side-menu')->section('subcontent');
    }

    public function datahijos()
    {
        $idafiliado             = User::select('idAffiliated')->where('userName', '=', $this->invitedby)->first();
        $this->SonAfiliate;
        $this->asignarSocio     = false;

        if ($idafiliado) {
            $this->nohijos      = false;
            $this->SonAfiliate  = DB::select('CALL sp_consultarhijos(?)', array(
                $idafiliado->idAffiliated
            ));
            sleep(1);
        } else {
            $this->nohijos = true;
        }

    }

    protected $rules = [
        'selectCity'                => 'required',
        'SSN'                       => 'required_if:selectCity,1|nullable|unique:affiliates,SSN',
        'RFC'                       => 'required_if:selectCity,2|nullable|unique:affiliates,RFC',
        'CURP'                      => 'required_if:selectCity,2|nullable|unique:affiliates,CURP',
        'DPI'                       => 'required_if:selectCity,3|nullable|unique:affiliates,DPI',
        'IP'                        => 'required_if:selectCity,4|nullable|unique:affiliates,IP',
        'fechaingreso'              => 'required',
        'invitedby'                 => 'required',
        'Email'                     => 'required|unique:affiliates',
        'confirmEmail'              => 'required|same:Email',
        'userName'                  => 'required|unique:users',
        'Name'                      => 'required|string',
        'LastName'                  => 'required|string',
        'AreaCodeAlternativePhone'  => 'required|string',
        'AlternativePhone'          => 'required|string',
        'AreaCodeWorkPhone'         => 'nullable|string',
        'WorkPhone'                 => 'nullable|string',
        'DateBirth'                 => 'required|string',
        'ZipCode'                   => 'required|string',
        'bankName'               => 'nullable|string',
        'bankAccount'               => 'nullable|string',
        'routingNumber'             => 'nullable|string',
        'typeAccount'               => 'nullable|string',
        'Password'                  => 'required',
        'password_confirmation'     => 'required|same:Password',
        'Address'                   => 'required',
        'selectedCountry'           => 'required',
        'selectedCity'              => 'required',
        'selectedState'             => 'required',
    ];

    protected $messages = [
        'SSN.unique'                        => 'El SSN ya esta en uso',
        'RFC.unique'                        => 'El RFC ya esta en uso',
        'CURP.unique'                       => 'El CURP ya esta en uso',
        'DPI.unique'                        => 'El DPI ya esta en uso',
        'IP.unique'                         => 'El ID Personal ya esta en uso',
        'userName.unique'                   => 'El usuario ya esta en uso',
        'password_confirmation.same'        => 'las contraseñas no coinciden',
        'Email.unique'                      => 'El Correo ya esta en uso',
        'confirmEmail.same'                 => 'Los correos no coinciden',

        'SSN.required_if'                   => 'El SSN es requerido',
        'RFC.required_if'                   => 'El RFC es requerido',
        'CURP.required_if'                  => 'El CURP es requerido',
        'DPI.required_if'                   => 'El DPI es requerido',
        'IP.required_if'                    => 'El ID Personal es requerido',
        'userName.required'                 => 'El usuario es requerido',
        'password_confirmation.required'    => 'la contraseña es requerida',
        'Password.required'                 => 'la contraseña es requerida',
        'Email.required'                    => 'El Correo es requerido',
        'confirmEmail.required'             => 'EL correo es requerido',
        'AreaCodeAlternativePhone.required'     => 'El código es requerido',
        'AlternativePhone.required'         => 'El número es requerido',
    ];

    public function create()
    {
       
        $confirmation_code              = Str::random(25);
        $datos                          = $this->validate();
        $datos['confirmation_code']     = $confirmation_code;
        $website                        = 'https://besanaglobal.com?sponsor=' . $datos['userName'];
        $pass                           = Hash::make($datos['Password']);
        $dateNow                        = Carbon::now()->format('Y-m-d H:i:s');
        $null                           = null;

        if (User::where('userName', $datos['invitedby'])->first()) {
            $user       = User::where('userName', $datos['invitedby'])->first();
            $fhater     = $user->idAffiliated;
            
            if ($this->asignarSocio) {
                $fhater = intval($this->asignacionSocio);
            }

            if ($this->selectBankAccount) {
                $bankName       = $this->bankName;
                $bank           = $this->bankAccount;
                $routingNumber  = $this->routingNumber; 
                $typeAccount    = $this->typeAccount;
            }else{
                $bankName       = null;
                $bank           = null;
                $routingNumber  = null; 
                $typeAccount    = null;
            }

            $ssn        = $datos['SSN']                 ? $datos['SSN']                 : null;
            $rfc        = $datos['RFC']                 ? $datos['RFC']                 : null;
            $curp       = $datos['CURP']                ? $datos['CURP']                : null;
            $dpi        = $datos['DPI']                 ? $datos['DPI']                 : null; 
            $ip         = $datos['IP']                  ? $datos['IP']                  : null;
            $CodeWPhone = $datos['AreaCodeWorkPhone']   ? $datos['AreaCodeWorkPhone']   : null;
            $WPhone     = $datos['WorkPhone']           ? $datos['WorkPhone']           : 0;
           
            try {

                $this->data = json_decode(json_encode(DB::select("CALL SpAffiliated (
                'NEW',
                0,
                '{$ssn}',
                '{$rfc}',
                '{$curp}',
                '{$dpi}',
                '{$ip}',
                '{$datos['Name']}',
                '{$datos['LastName']}',
                '{$datos['AreaCodeAlternativePhone']}',
                {$datos['AlternativePhone']},
                '{$CodeWPhone}',
                {$WPhone},
                '{$datos['DateBirth']}',
                '{$datos['Email']}',
                null,
                '{$datos['Address']}',
                '{$datos['selectedCountry']}',
                '{$datos['selectedState']}',
                '{$datos['selectedCity']}',
                {$datos['ZipCode']},
                '{$datos['AreaCodeAlternativePhone']}',
                {$datos['AlternativePhone']},
                '{$bankName}',
                '{$bank}',
                '{$routingNumber}',
                '{$typeAccount}',
                '-12.34566',
                '12.34566',
                '{$dateNow}',
                null,
                null,
                1,
                '{$datos['userName']}',
                '{$pass}',
                '{$user->idAffiliated}',
                '{$website}',
                '{$confirmation_code}',
                1,
                {$fhater}
                )")), true);

                Mail::send('livewire.register.confirmation_code', $datos, function ($message) use ($datos) {
                    $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
                });

                $this->dispatchBrowserEvent('noty', ['msg' => 'Hemos enviado un mensaje por correo, para realizar la confirmacion de mismo!.']);
            
                session()->flash('mensaje', '¡Registro Exitoso!');
                
                $this->Name                     = "";
                $this->LastName                 = "";
                $this->DateBirth                = "";
                $this->selectCity               = "";
                $this->SSN                      = "";
                $this->RFC                      = "";
                $this->CURP                     = "";
                $this->DPI                      = "";
                $this->IP                       = "";
                $this->userName                 = "";
                $this->AreaCodeWorkPhone        = "";
                $this->WorkPhone                = "";
                $this->AlternativePhone         = "";
                $this->AreaCodeAlternativePhone = "";
                $this->Email                    = "";
                $this->confirmEmail             = "";
                $this->Address                  = "";
                $this->selectedCountry          = "";
                $this->selectedState            = "";
                $this->selectedCity             = "";
                $this->ZipCode                  = "";
                $this->fhater                   = "";
                $this->bankName                 = "";
                $this->bankAccount              = "";
                $this->routingNumber            = ""; 
                $this->typeAccount              = "";
                $this->Latitude                 = "";
                $this->Longitude                = "";

                $this->asignarSocio             = false;
                $this->selectBankAccount        = false ;
                $this->Authorization            = false;

                return;
            } catch (\Throwable $th) {
                session()->flash('error', 'Error en Base de Datos' . $th);
                return;
            }
        } else {
            session()->flash('error', 'Usuario no Existe');
            return;
        }
    }

    public function verify($code)
    {
        $user = Affiliate::where('confirmation_code', $code)->first();

        if (!$user) {
            return redirect('/login');
        } else {
            $user->ConfirmedEmail       = true;
            $user->confirmation_code    = null;
            $user->save();
            return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
        }
    }
}
