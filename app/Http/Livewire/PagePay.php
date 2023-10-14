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

  public $onzasblade = 0;
  public $total;
  public $totalImpuestoShipping = 0;
  public $points = 0;
  public $taxtotal = 0;
  public $items = [];
  public $nameCard;
  public $user;
  public $cantidadProductos;
  public $subtotal;
  public $subtotalweb = 0;
  public $activo;
  public $taxes   = 0;
  public $taxTotal = 0;
  public $shipping = 0;
  public $totalcard = 0;
  public $cantidadinterna = 0;

  protected $stripe;
  protected $listeners = [
    'pay' => 'pay',
    'crearcliente' => 'crearcliente',
    'success' => 'success',
    'stripeError' => 'errorStripe'

  ];



  public function errorStripe($text){
    
    $this->dispatchBrowserEvent('noticiaError', ['msg' => $text]);
  }

  public function mount()
  {
    $this->total = \Cart::session(Auth()->user()->idUser)->getTotal();
  }

  public function render()
  {

    $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->getContent();
    $this->subtotal = \Cart::session(Auth()->user()->idUser)->getSubTotal();
    $this->user = Affiliate::where('idAffiliated', Auth()->user()->idAffiliated)->first();
    $b = $this->user;
    $STRIPE_KEY = config('services.stripe.STRIPE_KEY');
    $variable = config('services.stripe.STRIPE_SECRET');
    $this->total = \Cart::session(Auth()->user()->idUser)->getTotal();
    $totalonzas = 0;
    $membresia = 0;

    if (count($this->cantidadProductos) > 0) {
      foreach ($this->cantidadProductos as $key => $value) {
        if ($value->attributes->membresia) {
          $membresia = 24.95;
        }
       
        $totalonzas += $value->attributes->onzas * $value->quantity;
        $this->taxtotal += $value->attributes->tax;
      }

      $this->totalOnzas($totalonzas);
      $this->taxes();
      $taxsub = floatval($this->subtotal * $this->taxes / 100);

      foreach ($this->cantidadProductos as $key => $value) {
        if ($value->name == "MEMBERSHIP") {
          $this->subtotalweb = $this->subtotal + $taxsub ;
        } else {
          $this->subtotalweb = $this->subtotal + $taxsub + $membresia ;
        }
      }
      
      switch ($this->cantidadProductos[1]->attributes->symbolCurrent) {
        case '$':
            $this->shipping = floatval($this->shipping * 1); 
            break;
        case 'GTQ':
            $this->shipping =  floatval(7.8 * $this->shipping);
            break;
        case 'COP':
            $this->shipping = floatval(4171.57 * $this->shipping);
            break;
        case 'MXN':
            $this->shipping = floatval(17.28 * $this->shipping); 
            break;
    };

    $this->totalImpuestoShipping = $this->subtotalweb + $this->shipping;

      return view('livewire.page-pay', compact('b', 'STRIPE_KEY',))->extends('layout.side-menu')->section('subcontent');
    } else {
      return view('pages/dashboard-overview-1')->extends('layout.side-menu')->section('subcontent');
    }
  }

  public function pay($token, $name, $total, $member, $package)
  {
    $tok = $token;
    $variable = config('services.stripe.STRIPE_SECRET');
    $this->stripe = new \Stripe\StripeClient($variable);
    $idAfiliado = Auth()->user()->idAffiliated;

    if($member == 1){

      if($package !== "MEMBERSHIP"){
        $this->updateRank($idAfiliado);
      } 

      $this->finishpay($idAfiliado, $tok);
      $this->updateAffiliated($idAfiliado);

      $this->dispatchBrowserEvent('package', ['msg' => 'Compra exitosa, ya puede ingresar a su oficina!']);
       
    }else{

      $this->finishpay($idAfiliado, $tok);
      $this->updateAffiliated($idAfiliado);
      $this->ClearCart();

      $mensaje = '';
      $language = session()->get('locale');

      if ($language == 'en') {
        $mensaje = 'successful purchase!!.';
      } else {
        $mensaje = 'Compra Exitosa!!';
      }
      return redirect('/products')->with('success', $mensaje);

    }  
    
  }

  public function updateAffiliated($idAfiliado)
  {
    User::where('idAffiliated', $idAfiliado)->update(['active' => 1]);
  }
  public function updateRank($idAfiliado)
  {
    Affiliate::where('idAffiliated', $idAfiliado)->update(['idRank' => 2]);
  }

  public function finishpay($idAfiliado, $token)
  {
    $fechaHoraActual = Carbon::now();
    $fechaHoraMySQL = $fechaHoraActual->format('Y-m-d H:i:s');
    
    $result= DB::select('CALL SpSales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
             array(
                 'Sale',
                 $idAfiliado,
                 17,
                 Null,
                 $this->total,
                 'CREDIT CARD',
                 0,
                 $fechaHoraMySQL,
                 'office',
                 $this->user->Name,
                 $this->user->Phone,        
                 $this->user->Email,
                 $this->user->Address,
                 $this->user->Country,
                 $this->user->State,  
                 $this->user->City,
                 $this->user->ZipCode,
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
      $subtotal = number_format(floatval($pro['price'] + $pro['attributes']['tax']), 2);
      $description = "Cantidad: " . $pro['quantity'] . " Producto: " . $pro['name'] . " Subtotal: " . $subtotal . "\n";

      $detailV = new DetailSale();
      $detailV->id_sale = $idSale;
      $detailV->id_product = $pro['id'];
      $detailV->NameProduct = $pro['name'];
      $detailV->precioVenta = $pro['price'];
      $detailV->Tax = $pro['attributes']['tax'];
      $detailV->cantidad = $pro['quantity'];
      $detailV->subtotal = $subtotal;
      $detailV->save();
    }

    $this->stripe->charges->create([
      'amount' => number_format(floatval($this->totalImpuestoShipping), 2) * 100,
      'currency' => 'usd',
      'description' => $description,
      'receipt_email' => $this->user->Email,
      'source' => $token,

    ]);
  }
  public function ClearCart()
  {
    \Cart::session(Auth()->user()->idUser)->clear();
    $this->cantidadProductos = \Cart::getContent()->count();
  }

  public function totalOnzas($totalonzas)
  {
    $this->onzasblade = $totalonzas;
    if ($totalonzas == 0) {
      return $this->shipping = 0;
    }
    if ($totalonzas < 32) {
      return $this->shipping = 7;
    } else {
      $shippinadd = intval($totalonzas - 31);
      return $this->shipping = intval($shippinadd + 7);
    }
  }

  public function taxes()
  {
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

  public function incrementQuantity($id)
  {
    $this->cantidadProductos = \Cart::session(Auth()->user()->idUser)->update($id, [
      'quantity' => +1
    ]);
  }

  public function decrementQuantity($id)
  {
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

  public function success()
  {
    $this->ClearCart();
  }
}
