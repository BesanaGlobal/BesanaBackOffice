<?php

namespace App\Http\Livewire\Register;

use App\Models\Affiliate;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

use Illuminate\Support\Str;


class Register extends Component
{

    public $pais;
    public $terminos = false;
    public $lenguaje='english';
    public $invitedby;
    public $SSN='';
    public $Name='';
    public $LastName='';
    public $AlternativePhone;
    public $Workphone='000000000';
    public $DateBirth;
    public $Email='';
    
    public $confirmEmail='';
    public $Address='';
    public $Country='';
    public $State='';
    public $City='';
    public $ZipCode='';
    public $Phone='00000000';
    public $Latitude;
    public $Longitude;
    public $userName='';
    public $Password='';
    public $confirmPassword='';
    public array $data;
    public $message='';
    public $confirmation_code;
    public $password_confirmation;

    public function mount(String $id='besana'){
        $this->invitedby = $id;
        $this->lenguaje='spanish';
       
       
    }

    public function render()
    {
        return view('livewire.register.register')
                ->extends('layout.login')
                ->section('content');
    }
    protected $rules=[
        'SSN' => 'required|unique:affiliates',
        'invitedby'=>'required',
        'Email' => 'required|unique:affiliates',
        'confirmEmail' => 'required|same:Email', 
        'userName'=>'required|unique:users',  
        'Name'=>'required|string',
        'LastName'=>'required|string',
        'AlternativePhone'=>'nullable|string',
        'Workphone'=>'required|string',
        'DateBirth'=>'required|string',    
        'Address'=>'required|string',
        'Country'=>'required|string',
        'State'=>'required|string',
        'City'=>'required|string',
        'ZipCode'=>'required|string',
        'Phone'=>'required|string',  
        'Password'=>'required',
        'password_confirmation' => 'required|same:Password'
    ];

    protected $messages = [
        'SSN.unique' => 'El id ya esta en uso',
        'userName.unique'=>'El usuario ya esta en uso',
        'password_confirmation.same'=>'las contraseñas no coinciden',
        'Email.unique'=>'El Correo ya esta en uso',
        'confirmEmail.same'=>'Los correos no coinciden',
        
    ];
    public function create(){
       $confirmation_code =Str::random(25);
       $datos = $this->validate();

       $datos['confirmation_code'] = $confirmation_code;
       $mytime = Carbon::now();
       $null='nulll';
       $createdAt = Carbon::parse($datos['DateBirth']);
       $dateBirth=$createdAt->format('M d Y');
       $datecreated=$mytime->format('Y-m-d h:i');
       $website='https://www.besanaglobal.com/'.$datos['userName'];
       $pass=Hash::make($datos['Password']);
            try {
                $user=User::where('userName', $datos['invitedby'])->first();
                $fhater=$user->idAffiliated;
            $this->data = json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated (
                'NEW',
                0,
                '{$datos['SSN']}',
                '{$datos['Name']}',
                '{$datos['LastName']}',
                {$datos['Workphone']},
                {$datos['Phone']},
                '{$datos['DateBirth']}',
                '{$datos['Email']}',
                null,
                '{$datos['Address']}',
                '{$datos['Country']}',
                '{$datos['State']}',
                '{$datos['City']}',
                {$datos['ZipCode']},
                '333.333',
                '12.345545',
                '-12.34566',
                '$datecreated',
                null,
                null,
                1,
                '{$datos['userName']}',
                '{$pass}',
                1,
                '{$website}',
                '{$confirmation_code}',
                3,
                {$fhater}
                )")),true);

                Mail::send('livewire.register.confirmation_code', $datos, function($message) use ($datos) {
                    $message->to($datos['Email'], $datos['Name'])->subject('Por favor confirma tu correo');
                });
                $this->reset('SSN', 'Name', 'LastName', 'AlternativePhone','Workphone',  'DateBirth', 'Email','Address', 'Country','State','City','ZipCode','Phone','userName');
                return redirect()->to('/login')->with(["notification" => 'We have send a menssage to your for confirm your register']);
                
                // return redirect()->route('login')->with([ 'mensaje' => 'e have send a menssage to your for confirm your register' ]);
                //$this->dispatchBrowserEvent('noty', ['msg' => 'We have send a menssage to your for confirm your register']);
                // return view('layout.login')->with("mensaje", "We have send a menssage to your for confirm your register ");
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('noty', ['msg' => 'error de transaccion en base de datos: '.$th]);
                return;
            }

    }

    public function verify($code) 
    {
        $user = Affiliate::where('confirmation_code', $code)->first();
       
      
        if (! $user){

            return redirect('/login');
        }else{
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
