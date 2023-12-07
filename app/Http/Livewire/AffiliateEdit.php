<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\Hash;
use App\Models\Affiliate;
use App\Models\Rank;
use Livewire\Component;
use Illuminate\Support\Carbon;


class AffiliateEdit extends Component
{

    // public $claveVieja;
    // public $claveNueva;

    public $lenguaje = 'english';
    public $idAffiliated;
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
    public $userName;    
    public $AreaCodeWorkPhone;
    public $WorkPhone;
    public $AreaCodeAlternativePhone;
    public $AlternativePhone;
    public $Email;
    public $Address;
    public $selectedCountry;
    public $selectedState;
    public $selectedCity;
    public $ZipCode;
    public $bankAccount;
    public $routingNumber;
    public $typeAccount;
    public $Latitude;
    public $Longitude;
    public $rank;
    public $idRank;
    public $nameRank;
    public $selectBankAccount   = false;
    public $Authorization       = false;


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

    public function mount($id)
    {

        $this->lenguaje = 'spanish';
        $this->idAffiliated = $id;
        
        $affiliate        = Affiliate::where('idAffiliated', $id)->with('user','rank')->get();
        $this->rank       = Rank::all();

        $this->fechaingreso     = Carbon::parse($affiliate[0]->CreatedAt)->format('d/m/Y');
        $this->Name             = $affiliate[0]->Name;
        $this->LastName         = $affiliate[0]->LastName;
        $this->DateBirth        = $affiliate[0]->DateBirth;
        $this->SSN              = $affiliate[0]->SSN;
        $this->RFC              = $affiliate[0]->RFC;
        $this->CURP             = $affiliate[0]->CURD;
        $this->DPI              = $affiliate[0]->DPI;
        $this->IP               = $affiliate[0]->IP;  
        $this->WorkPhone        = $affiliate[0]->WorkPhone;
        $this->AlternativePhone = $affiliate[0]->AlternativePhone;
        $this->Email            = $affiliate[0]->Email;
        $this->Address          = $affiliate[0]->Address;
        $this->selectedCountry  = $affiliate[0]->Country;
        $this->selectedState    = $affiliate[0]->State;
        $this->selectedCity     = $affiliate[0]->City; 
        $this->ZipCode          = $affiliate[0]->ZipCode;
        $this->Latitude         = $affiliate[0]->Latitude;
        $this->Longitude        = $affiliate[0]->Longitude;
        $this->userName         = $affiliate[0]->user->userName;
        $this->idRank           = $affiliate[0]->idRank;
        $this->nameRank         = $affiliate[0]->rank->RankName;

        if(
            $affiliate[0]->BankAccount == NULL   && $affiliate[0]->RoutingNumber == NULL  && $affiliate[0]->TypeAccount == NULL ||
            $affiliate[0]->BankAccount == ""     && $affiliate[0]->RoutingNumber == ""    && $affiliate[0]->TypeAccount == "" 
        ){
            $this->selectBankAccount    = false;
            $this->bankAccount          = "";
            $this->routingNumber        = "";
            $this->typeAccount          = "";
            $this->Authorization        = false;
        }else {
            
            $this->selectBankAccount    = true;
            $this->bankAccount          = $affiliate[0]->BankAccount;
            $this->routingNumber        = $affiliate[0]->RoutingNumber;
            $this->typeAccount          = $affiliate[0]->TypeAccount;
            $this->Authorization        = true;
        }

        if( $this->SSN != ""){
            $this->selectCity = 1;
        }
        if( $this->RFC != "" && $this->CURP != "" ){
            $this->selectCity = 2;
        }
        if( $this->DPI != ""){
            $this->selectCity = 3;
        }
        if( $this->IP != ""){
            $this->selectCity = 4;
        }

        // if($affiliate[0]->Country == "Usa" || $affiliate[0]->Country == "United States" ){
        //     $this->selectedCountry = "EE UU";
        // }

        // if($affiliate[0]->Country == "Guatemalaa"){
        //     $this->selectedCountry = "Guatemala";
        // }

        // if($affiliate[0]->Country == "Panama"){
        //     $this->selectedCountry = "Panamá";
        // }

    }

    protected $rules = [
        'SSN'                   => 'required_if:selectCity,1|unique:affiliates',
        'RFC'                   => 'required_if:selectCity,2|unique:affiliates',
        'CURP'                  => 'required_if:selectCity,2|unique:affiliates',
        'DPI'                   => 'required_if:selectCity,3|unique:affiliates',
        'IP'                    => 'required_if:selectCity,4|unique:affiliates',
        'fechaingreso'          => 'required',
        'Email'                 => 'required|unique:affiliates',
        'userName'              => 'required|unique:users',
        'Name'                  => 'required|string',
        'LastName'              => 'required|string',
        'AlternativePhone'      => 'required|string',
        'WorkPhone'             => 'string',
        'DateBirth'             => 'required|string',
        'bankAccount'           => 'nullable|string',
        'routingNumber'         => 'nullable|string',
        'typeAccount'           => 'nullable|string',
        'ZipCode'               => 'required|string',
        'Address'               => 'required',
        'selectedCountry'       => 'required',
        'selectedCity'          => 'required',
        'selectedState'         => 'required',
    ];

    protected $messages = [
        'SSN.unique'        => 'El SSN ya esta en uso',
        'RFC.unique'        => 'El RFC ya esta en uso',
        'CURP.unique'       => 'El CURP ya esta en uso',
        'DPI.unique'        => 'El DPI ya esta en uso',
        'IP.unique'         => 'El ID Personal ya esta en uso',
        'userName.unique'   => 'El usuario ya esta en uso',
        'Email.unique'      => 'El Correo ya esta en uso',

        'SSN.required_if'   => 'El SSN es requerido',
        'RFC.required_if'   => 'El RFC es requerido',
        'CURP.required_if'  => 'El CURP es requerido',
        'DPI.required_if'   => 'El DPI es requerido',
        'IP.required_if'    => 'El ID Personal es requerido',
        'userName.required' => 'El usuario es requerido',
        'Email.required'    => 'El Correo es requerido',
    ];

    public function update(){
        $affiliate  = Affiliate::where('idAffiliated', $this->idAffiliated)->with('user','rank');

        if($this->selectBankAccount == false){
            $this->bankAccount          = null;
            $this->routingNumber        = null;
            $this->typeAccount          = null;            
        }

        // $this->validate();
        $affiliate->update([
            'Name'             =>  $this->Name,
            'LastName'         =>  $this->LastName,
            'DateBirth'        =>  $this->DateBirth,
            'SSN'              =>  $this->SSN,
            'RFC'              =>  $this->RFC,
            'CURP'             =>  $this->CURP,
            'DPI'              =>  $this->DPI,
            'IP'               =>  $this->IP,  
            'WorkPhone'        =>  $this->AreaCodeWorkPhone . $this->WorkPhone,
            'AlternativePhone' =>  $this->AreaCodeAlternativePhone . $this->AlternativePhone,
            'Email'            =>  $this->Email,
            'Address'          =>  $this->Address,
            'Country'          =>  $this->selectedCountry,
            'State'            =>  $this->selectedState,
            'City'             =>  $this->selectedCity, 
            'ZipCode'          =>  $this->ZipCode,
            'BankAccount'      =>  $this->bankAccount,
            'RoutingNumber'    =>  $this->routingNumber,
            'TypeAccount'      =>  $this->typeAccount,
            'Latitude'         =>  $this->Latitude,
            'Longitude'        =>  $this->Longitude,
            'ModifiedAt'       =>  Carbon::now(),
            'idRank'           =>  $this->idRank,
        ]);

        $affiliate->first()->user()->update([
            'userName'    =>  $this->userName,
        ]);

        $this->dispatchBrowserEvent('noty', ['msg' => 'Datos actualizados Correctamente.']);

    }

    public function render()
    {
        return view('livewire.affiliateEdit')->extends('layout.side-menu')->section('subcontent');
    }

    // public function like(){

    //     $this->claveNueva = Hash::make($this->claveVieja);

    // }



}
