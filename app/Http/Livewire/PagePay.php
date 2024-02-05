<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Affiliate;
use App\Models\DetailSale;
use App\Models\User;
use Carbon\Carbon;
use Stripe;

class PagePay extends Component
{

  public $onzasblade            = 0;
  public $total;
  public $totalImpuestoShipping = 0;
  public $points                = 0;
  public $taxtotal              = 0;
  public $items                 = [];
  public $nameCard;
  public $user;
  public $cantidadProductos;
  public $subtotal;
  public $subtotalweb           = 0;
  public $activo;
  public $taxes                 = 0;
  public $taxTotal              = 0;
  public $shipping              = 0;
  public $totalcard             = 0;
  public $cantidadinterna       = 0;
  public $current;
  public $symbolCurrent;
  public $viewStatus;
  public $totalPay;
  public $activatedBuy;
  public $totalPoints;

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
    
  public $selectedOption    = "option1";
  public $zipCode;
  public $alternativeAddress; 
  public $States;
  public $Cities;
  public $selectedCountry;
  public $selectedState;
  public $selectedCity;
  
  protected $stripe;
  protected $listeners = [
    'pay'           => 'pay',
    'crearcliente'  => 'crearcliente',
    'success'       => 'success',
    'stripeError'   => 'errorStripe'

  ];

  public function updatedSelectedCountry($country){
    if (!is_null($country)) {
        $this->States = $this->Countries[$country];
    }  
  }

  public function errorStripe($text){
    $this->dispatchBrowserEvent('noticiaError', ['msg' => $text]);
  }

  public function mount(){
    $this->total = \Cart::session(Auth()->user()->idUser)->getTotal();
  }

  public function taxReload(){
    if ($this->selectedOption === "option1") {
      $state = $this->user->State;
      switch ($state) {
        case 'Nevada':
          return $this->taxes = 8.375;
          break;
        default:
          return  $this->taxes = 0;
          break;
      }

    }else{
      $state = $this->selectedState;
      switch ($state) {
        case 'Nevada':
          return $this->taxes = 8.375;
          break;
        default:
          return  $this->taxes = 0;
          break;
      }
    }

  }

  public function render(){
    $STRIPE_KEY               = config('services.stripe.STRIPE_KEY');
    $variable                 = config('services.stripe.STRIPE_SECRET');
    $this->user               = Affiliate::where('idAffiliated', Auth()->user()->idAffiliated)->first();
    $b                        = $this->user;
    $this->cantidadProductos  = \Cart::session(Auth()->user()->idUser)->getContent();
    $this->subtotal           = \Cart::session(Auth()->user()->idUser)->getSubTotal();
    $this->total              = \Cart::session(Auth()->user()->idUser)->getTotal();
    $totalonzas               = 0;
    $membresia                = 0;

    if (count($this->cantidadProductos) > 0) {
      foreach ($this->cantidadProductos as $key => $value) {
        if ($value->attributes->membresia) {
          $membresia          = $value->attributes->membresia;
          $this->viewStatus   = 1;
        }
        $totalonzas         += $value->attributes->onzas * $value->quantity;
        $this->taxtotal     += floatval(str_replace(',', '', $value->attributes->tax));
      }

      $this->totalOnzas($totalonzas); 
      $this->taxReload();

      $taxsub = floatval($this->subtotal * $this->taxes / 100);

      foreach ($this->cantidadProductos as $key => $value) {
        if ($value->name == "MEMBERSHIP") {
          $this->subtotalweb  = $this->subtotal + $taxsub;
        } else {
          $this->subtotalweb  = $this->subtotal + $taxsub + $membresia;
        }
      }

      foreach($this->cantidadProductos as $value){}
      
      if($value['attributes']->symbolCurrent){
        switch ($value['attributes']->symbolCurrent) {
          case '$':
              $this->shipping = floatval($this->shipping * 1); 
              $this->current  = "USD";
              break;
          case 'GTQ':
              $this->shipping =  floatval(7.8 * $this->shipping);
              $this->current  = "GTQ";
              break;
          case 'COP':
              $this->shipping = floatval(4171.57 * $this->shipping);
              $this->current  = "COP";
              break;
          case 'MXN':
              $this->shipping = floatval(17.28 * $this->shipping); 
              $this->current  = "MXN";
              break;
        };

      }

      $this->symbolCurrent          = $value['attributes']->symbolCurrent;
      $this->totalImpuestoShipping  = $this->subtotalweb + $this->shipping;

      return view('livewire.page-pay', compact('b', 'STRIPE_KEY',))->extends('layout.side-menu')->section('subcontent');
    } else {
      return view('pages/dashboard-overview-1')->extends('layout.side-menu')->section('subcontent');
    }
  }

  public function pay($token, $name, $total, $points, $member, $package)
  {
    $tok                = $token;
    $variable           = config('services.stripe.STRIPE_SECRET');
    $this->stripe       = new \Stripe\StripeClient($variable);
    $idAfiliado         = Auth()->user()->idAffiliated;
    $this->totalPay     = floatval(str_replace(',', '', $total));
    $this->totalPoints  = floatval(str_replace(',', '', $points));

    if($member == 1){
      if($package !== "MEMBERSHIP"){
        $this->updateRank($idAfiliado);
      } 
      $this->activatedBuy = 1;
      $this->finishpay($idAfiliado, $tok);
      $this->updateAffiliated($idAfiliado);
      $this->dispatchBrowserEvent('package', ['msg' => 'Compra exitosa, ya puede ingresar a su oficina!']);
    }else{
      $this->activatedBuy = 0;
      $this->finishpay($idAfiliado, $tok);
      $this->updateAffiliated($idAfiliado);
      $this->ClearCart();

      $mensaje  = '';
      $language = session()->get('locale');

      if ($language == 'en') {
        $mensaje = 'successful purchase!!.';
      } else {
        $mensaje = 'Compra Exitosa!!';
      }
      return redirect('/products')->with('success', $mensaje);

    }  
    
  }

  public function updateAffiliated($idAfiliado){
    User::where('idAffiliated', $idAfiliado)->update(['active' => 1]);
  }

  public function updateRank($idAfiliado){
    Affiliate::where('idAffiliated', $idAfiliado)->update(['idRank' => 2]);
  }

  public function finishpay($idAfiliado, $token)
  {
    $fechaHoraActual  = Carbon::now();
    $fechaHoraMySQL   = $fechaHoraActual->format('Y-m-d H:i:s');

    if ($this->selectedOption == "option2") {
      $zipCode = $this->zipCode;
      $address = $this->alternativeAddress;
      $country = $this->selectedCountry;
      $state   = $this->selectedState;
      $city    = $this->selectedCity;
    }else{
      $zipCode = $this->user->ZipCode;
      $address = $this->user->Address;
      $country = $this->user->Country;
      $state   = $this->user->State;
      $city    = $this->user->City;
    }
    
    $result= DB::select('CALL SpSales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
             array(
                 'Sale',
                 $idAfiliado,
                 Null,
                 $this->symbolCurrent,
                 $this->totalPay,
                 $this->totalPoints,
                 'CREDIT CARD',
                 $this->activatedBuy,
                 $fechaHoraMySQL,
                 'office',
                 $this->user->Name,
                 $this->user->Phone,        
                 $this->user->Email,
                 $address,
                 $country,
                 $state,  
                 $city,
                 $zipCode,
                 $this->shipping,
                 0,
                 0
             )
         );

    $idSale = $result[0]->last_inserted_id;
    $this->DetailSale($idSale, $token);
  }

  public function DetailSale($idSale, $token)
  {
    foreach ($this->cantidadProductos as $pro) {
      $subtotal     = floatval($pro['price'] + $pro['attributes']['tax']);
      $description  = "Cantidad: " . $pro['quantity'] . " Producto: " . $pro['name'] . " Subtotal: " . $subtotal . "\n";

      $detailV              = new DetailSale();
      $detailV->id_sale     = $idSale;
      $detailV->id_product  = $pro['id'];
      $detailV->NameProduct = $pro['name'];
      $detailV->precioVenta = $pro['price'];
      $detailV->pointsProd  = $pro['attributes']['puntos'];
      $detailV->Tax         = $pro['attributes']['tax'];
      $detailV->cantidad    = $pro['quantity'];
      $detailV->subtotal    = $subtotal;
      $detailV->save();
    }

    $amount   = intval($this->totalImpuestoShipping * 100);

    $this->stripe->charges->create([
      'amount'        => $amount,
      'currency'      => $this->current,
      'description'   => $description,
      'receipt_email' => $this->user->Email,
      'source'        => $token,

    ]);
  }
  public function ClearCart(){
    \Cart::session(Auth()->user()->idUser)->clear();
    $this->cantidadProductos = \Cart::getContent()->count();
  }

  public function totalOnzas($totalonzas){
    $this->onzasblade = $totalonzas;
    if ($totalonzas == 0) {
      return $this->shipping = 0;
    }
    if ($totalonzas < 32) {
      return $this->shipping = 7;
    } else {
      $shippinadd             = intval($totalonzas - 31);
      return $this->shipping  = intval($shippinadd + 7);
    }
  }

  public function taxes(){
    $state = $this->user->State;
    
    switch ($state) {
      case 'Nevada':
        return $this->taxes = 8.375;
        break;
      default:
        return  $this->taxes = 0;
        break;
    }
  }

  public function incrementQuantity($id){
    $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->update($id, [
      'quantity' => +1
    ]);
  }

  public function decrementQuantity($id){
    $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->get($id);
    if ($this->cantidadProductos->quantity == 1) {
      $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->remove($id);
      if ($this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->isEmpty()) {
        $language = session()->get('locale');
        if ($language == 'en') {
          $mensaje = 'Car empty!!.';
        } else {
          $mensaje = 'Carrito vacio!!';
        }
        return redirect('/products')->with('success', $mensaje);
      }
    } else {
      $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->update($id, [
        'quantity' => -1
      ]);
    }
  }

  public function success(){
    $this->ClearCart();
  }

  public function Cleaning(){
    \Cart::session(Auth()->user()->idUser)->clear();
    $this->cantidadProductos  = \Cart::session(Auth()->user()->idUser)->getContent()->count();
    return redirect('/products');
  }

}
