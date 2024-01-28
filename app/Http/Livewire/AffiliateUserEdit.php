<?php

namespace App\Http\Livewire;

use App\Models\Affiliate;
use Livewire\Component;
use Illuminate\Support\Carbon;


class AffiliateUserEdit extends Component
{

    public $lenguaje = 'english';
    public $idAffiliated;
    public $selectCity;
    public $AreaCodeWorkPhone;
    public $WorkPhone;
    public $AreaCodeAlternativePhone;
    public $AlternativePhone;
    public $Address;
    public $selectedCountry;
    public $selectedState;
    public $selectedCity;
    public $ZipCode;
    public $bankAccount;
    public $routingNumber;
    public $typeAccount;
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

            if($country == "Usa" || $country == "United States" ){
                    $country = "EE UU";
                }
        
            if($country == "Guatemalaa"){
                $country = "Guatemala";
            }
    
            if($country == "Panama"){
                $country = "Panamá";
            }

           $this->States = $this->Countries[$country];
        }
    }

    public function mount($id)
    {
        $id = base64_decode($id);
        $this->lenguaje = 'spanish';
        $this->idAffiliated = $id;
    
        $affiliate        = Affiliate::where('idAffiliated', $id)->with('user')->get();

        if($affiliate[0]->Country){
            $this->updatedSelectedCountry($affiliate[0]->Country);
        }

        $this->AreaCodeWorkPhone        = $affiliate[0]->CodeWorkPhone;
        $this->WorkPhone                = $affiliate[0]->WorkPhone;
        $this->AreaCodeAlternativePhone = $affiliate[0]->CodeAlternativePhone;
        $this->AlternativePhone         = $affiliate[0]->AlternativePhone;
        $this->Address                  = $affiliate[0]->Address;
        $this->selectedCountry          = $affiliate[0]->Country;
        $this->selectedState            = $affiliate[0]->State;
        $this->selectedCity             = $affiliate[0]->City; 
        $this->ZipCode                  = $affiliate[0]->ZipCode;
       
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

    }

    public function update(){
        $affiliate  = Affiliate::where('idAffiliated', $this->idAffiliated)->with('user','rank');

        if($this->selectBankAccount == false){
            $this->bankAccount          = null;
            $this->routingNumber        = null;
            $this->typeAccount          = null;            
        }

        $affiliate->update([
            
            'CodeWorkPhone'             =>  $this->AreaCodeWorkPhone,
            'WorkPhone'                 =>  $this->WorkPhone,
            'CodeAlternativePhone'      =>  $this->AreaCodeAlternativePhone,
            'AlternativePhone'          =>  $this->AlternativePhone,
            'Address'                   =>  $this->Address,
            'Country'                   =>  $this->selectedCountry,
            'State'                     =>  $this->selectedState,
            'City'                      =>  $this->selectedCity, 
            'ZipCode'                   =>  $this->ZipCode,
            'BankAccount'               =>  $this->bankAccount,
            'RoutingNumber'             =>  $this->routingNumber,
            'TypeAccount'               =>  $this->typeAccount,
            'ModifiedAt'                =>  Carbon::now(),
        ]);

        $this->dispatchBrowserEvent('noty', ['msg' => 'Datos actualizados Correctamente.']);

    }

    public function render()
    {
        return view('livewire.affiliateUserEdit')->extends('layout.side-menu')->section('subcontent');
    }

}
