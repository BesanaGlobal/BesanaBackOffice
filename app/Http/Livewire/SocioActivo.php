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

class SocioActivo extends Component
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
    public $IP = "";
    public $fechaingreso = null;
    public $invitedby;
    public $userName;
    public $Password;
    public $confirmPassword;
    
    public $SonAfiliate = [];
    public $asignarSocio = false;
    public $asignacionSocio;
    public $WorkPhone = "";
    public $AlternativePhone;
    public $Email;
    public $confirmEmail;
    public $Address;
    public $selectedCountry = null;
    public $selectedState = null;
    public $selectedCity= null;
    
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
        $this->selectCity = 1;
        $this->invitedby = $id;
        $this->lenguaje = 'spanish';

    }

    public function render()
    {
        $idafiliado = Auth()->user()->idAffiliated;
        // $this->SonAfiliate = DB::select('CALL sp_consultarhijos(?)', array(
        //     $idafiliado
        // ));

        $this->SonAfiliate = DB::table('relsponsor')
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

        $this->invitedby = Auth()->user()->userName;

        return view('livewire.socio-activo')->extends('layout.basenew')->section('subcontent');
    }

    public function datahijos()
    {
        $idafiliado = User::select('idAffiliated')->where('userName', '=', $this->invitedby)->first();
        $this->SonAfiliate;
        $this->asignarSocio = false;
        if ($idafiliado) {
            $this->nohijos = false;
            $this->SonAfiliate = DB::select('CALL sp_consultarhijos(?)', array(
                $idafiliado->idAffiliated
            ));
            sleep(1);
        } else {
            $this->nohijos = true;
        }
    }

    protected $rules = [
        'SSN' => 'required_if:selectCity,1|unique:affiliates',
        'RFC' => 'required_if:selectCity,2|unique:affiliates',
        'CURP' => 'required_if:selectCity,2|unique:affiliates',
        'DPI' => 'required_if:selectCity,3|unique:affiliates',
        'IP' => 'required_if:selectCity,4|unique:affiliates',
        'fechaingreso' => 'required',
        'invitedby' => 'required',
        'Email' => 'required|unique:affiliates',
        'confirmEmail' => 'required|same:Email',
        'userName' => 'required|unique:users',
        'Name' => 'required|string',
        'LastName' => 'required|string',
        'AlternativePhone' => 'required|string',
        'WorkPhone' => 'string',
        'DateBirth' => 'required|string',
        'ZipCode' => 'required|string',
        'Password' => 'required',
        'password_confirmation' => 'required|same:Password',
        'Address'=>'required',
        'selectedCountry'=>'required',
        'selectedCity'=>'required',
        'selectedState'=>'required',
    ];

    protected $messages = [
        'SSN.unique' => 'El SSN ya esta en uso',
        'RFC.unique' => 'El RFC ya esta en uso',
        'CURP.unique' => 'El CURP ya esta en uso',
        'DPI.unique' => 'El DPI ya esta en uso',
        'IP.unique' => 'El ID Personal ya esta en uso',
        'userName.unique' => 'El usuario ya esta en uso',
        'password_confirmation.same' => 'las contraseñas no coinciden',
        'Email.unique' => 'El Correo ya esta en uso',
        'confirmEmail.same' => 'Los correos no coinciden',

        'SSN.required_if' => 'El SSN es requerido',
        'RFC.required_if' => 'El RFC es requerido',
        'CURP.required_if' => 'El CURP es requerido',
        'DPI.required_if' => 'El DPI es requerido',
        'IP.required_if' => 'El ID Personal es requerido',
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
        $null = 'null';
        $createdAt = Carbon::parse($datos['DateBirth']);
        $dateBirth = $createdAt->format('M d Y');
        $datecreated = $mytime->format('Y-m-d h:i');
        $website = 'https://besanaglobal.com?sponsor=' . $datos['userName'];
        $pass = Hash::make($datos['Password']);

        //User::where('userName', $datos['invitedby'])->first();
        if (User::where('userName', $datos['invitedby'])->first()) {
            $user = User::where('userName', $datos['invitedby'])->first();
            $fhater = $user->idAffiliated;
            if ($this->asignarSocio) {
                $fhater = intval($this->asignacionSocio);
            }

            $ssn = $datos['SSN'] ? $datos['SSN'] : null ;
            $rfc = $datos['RFC'] ? $datos['RFC'] : null ;
            $curp = $datos['CURP'] ? $datos['CURP'] : null ;
            $dpi = $datos['DPI'] ? $datos['DPI'] : null ; 
            $ip = $datos['IP'] ? $datos['IP'] : null;
            $WPhone = $datos['WorkPhone'] ? $datos['WorkPhone'] : null;
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
                '{$datos['AlternativePhone']}',
                '{$WPhone}',
                '{$datos['DateBirth']}',
                '{$datos['Email']}',
                null,
                '{$datos['Address']}',
                '{$datos['selectedCountry']}',
                '{$datos['selectedState']}',
                '{$datos['selectedCity']}',
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
                1,
                {$fhater}
                )")), true);

                Mail::send('livewire.register.confirmation_code', $datos, function ($message) use ($datos) {
                    $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
                });

                $this->dispatchBrowserEvent('noty', ['msg' => 'Hemos enviado un mensaje por correo, para realizar la confirmacion de mismo!.']);
                // $this->reset('SSN', 'Name', 'LastName', 'AlternativePhone', 'Workphone', 'DateBirth', 'Email', 'Address', 'Country', 'State', 'City', 'ZipCode',  'userName', 'confirmEmail','invitedby','asignacionSocio');
                // $this->dispatchBrowserEvent('noty', ['msg' => 'Nuevo socio Activo: ' . $datos['userName']]);
                
                session()->flash('mensaje', '¡Registro Exitoso!');
                
                $this->Name = "";
                $this->LastName = "";
                $this->DateBirth = "";
                $this->selectCity = "1";
                $this->SSN = "";
                $this->RFC = "";
                $this->CURP = "";
                $this->DPI = "";
                $this->IP = "";
                $this->fechaingreso = "";
                $this->invitedby;
                $this->userName = "";
                $this->Password = "";
                $this->confirmPassword = "";
                $this->WorkPhone = "";
                $this->AlternativePhone = "";
                $this->Email = "";
                $this->confirmEmail = "";
                $this->Address = "";
                $this->selectedCountry = "";
                $this->selectedState = "";
                $this->selectedCity = "";
                $this->ZipCode = "";
                $this->fhater = "";
                $this->Latitude = "";
                $this->Longitude = "";

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
            $user->ConfirmedEmail = true;
            $user->confirmation_code = null;
            $user->save();
            return redirect('/login')->with('notification', 'You have confirmed your email correctly!');
        }
    }
}
