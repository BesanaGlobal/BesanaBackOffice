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
            'Alabama' => ['Birmingham', 'Montgomery'],
            'Alaska' => ['Anchorage', 'Fairbanks'],
            'Arizona' => ['Phoenix', 'Tucson'],
            'Arkansas' => ['Little Rock', 'Fort Smith'],
            'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
            'Colorado' => ['Denver', 'Colorado Springs'],
            'Connecticut' => ['Hartford', 'Bridgeport'],
            'Delaware' => ['Wilmington', 'Dover'],
            'Florida' => ['Jacksonville', 'Miami', 'Tampa'],
            'Georgia' => ['Atlanta', 'Augusta'],
            'Hawaii' => ['Honolulu', 'Hilo'],
            'Idaho' => ['Boise', 'Nampa'],
            'Illinois' => ['Chicago', 'Springfield'],
            'Indiana' => ['Indianapolis', 'Fort Wayne'],
            'Iowa' => ['Des Moines', 'Cedar Rapids'],
            'Kansas' => ['Wichita', 'Topeka'],
            'Kentucky' => ['Louisville', 'Lexington'],
            'Luisiana' => ['New Orleans', 'Baton Rouge'],
            'Maine' => ['Portland', 'Lewiston'],
            'Maryland' => ['Baltimore', 'Annapolis'],
            'Massachusetts' => ['Boston', 'Worcester'],
            'Michigan' => ['Detroit', 'Grand Rapids'],
            'Minnesota' => ['Minneapolis', 'Saint Paul'],
            'Misisipi' => ['Jackson', 'Gulfport'],
            'Misuri' => ['St. Louis', 'Kansas City'],
            'Montana' => ['Billings', 'Missoula'],
            'Nebraska' => ['Omaha', 'Lincoln'],
            'Nevada' => ['Las Vegas', 'Reno'],
            'New Hampshire' => ['Manchester', 'Nashua'],
            'Nueva Jersey' => ['Newark', 'Jersey City'],
            'Nuevo Mexico' => ['Albuquerque', 'Las Cruces'],
            'Nueva York' => ['New York City', 'Buffalo', 'Rochester'],
            'Carolina del Norte' => ['Charlotte', 'Raleigh'],
            'Carolina del Sur' => ['',''],
            'Dakota del Norte' => ['Bismarck', 'Fargo'],
            'Dakota del Sur' => ['Pierre', 'Sioux Falls'],
            'Ohio' => ['Cleveland', 'Columbus', 'Cincinnati'],
            'Oklahoma' => ['Oklahoma City', 'Tulsa'],
            'Oregon' => ['Portland', 'Salem'],
            'Pensilvania' => ['Philadelphia', 'Pittsburgh'],
            'Rhode Island' => ['Providence', 'Pawtucket'],
            'Carolina del Sur' => ['Columbia', 'Charleston'],
            'Tennessee' => ['Nashville', 'Memphis'],
            'Texas' => ['Houston', 'Dallas', 'Austin'],
            'Utah' => ['Salt Lake City', 'Provo'],
            'Vermont' => ['Montpelier', 'Burlington'],
            'Virginia' => ['Richmond', 'Virginia Beach'],
            'Washington' => ['Seattle', 'Spokane'],
            'West Virginia' => ['Charleston', 'Huntington'],
            'Wisconsin' => ['Milwaukee', 'Madison'],
            'Wyoming' => ['Cheyenne', 'Casper'],
        ],
        // 'Canada' => ['Toronto', 'Montreal', 'Vancouver'],
        // 'Mexico' => ['Mexico City', 'Guadalajara', 'Monterrey']
    ];

    public $States;
    public $Cities;

    public function updatedSelectedCountry($country)
    {
        if (!is_null($country)) {
           $this->States = $this->Countries[$country];
        }
    }

    public function updatedSelectedState($state)
    {
        if (!is_null($state)) {
            $this->Cities = array_values($this->States[$state]);
        }
    }


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
        'Address'=>'required',
        'selectedCountry'=>'required',
        'selectedCity'=>'required',
        'selectedState'=>'required',
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
                3,
                {$fhater}
                )")), true);

            Mail::send('livewire.register.confirmation_code', $datos, function ($message) use ($datos) {
                $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
            });
          
            $this->reset(
                'SSN',
                'RFC',
                'CURP',
                'DPI',
                'fechaingreso',
                'invitedby',
                'Email',
                'confirmEmail',
                'userName',
                'Name',
                'LastName',
                'AlternativePhone',
                'WorkPhone',
                'DateBirth',
                'Address',
                'selectedCountry',
                'selectedState',
                'selectedCity',
                'ZipCode',
                'Password',
                'password_confirmation',
            );
            $this->dispatchBrowserEvent('noty', ['msg' => 'te hemos enviado un mensaje por correo, confirmalo!.']);
            $this->hydrate();
            
       
            
             // return redirect()->to('/login');
        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('noty', ['msg' => 'error de transaccion en base de datos: ' . $th]);
            return;
        };

    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    // public function hydrate(): void
    // {
    //     $this->resetErrorBag();
    //     $this->resetValidation();
    // }

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
