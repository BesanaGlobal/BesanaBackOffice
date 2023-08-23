<?php

namespace App\Http\Livewire;

use App\Models\Website;

use Livewire\Component;
use App\Models\Affiliate;
use App\Models\DetailSale;
use App\Models\Point;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Stripe;
use DB;
class PagePay extends Component
{
    
   public $onzasblade=0;
    public $total;
    public $totalImpuestoShipping=0;
    public $points=0;
    public $taxtotal=0;
    public $items=[];
    public $nameCard;
     protected $stripe;
    public $user;
    public $cantidadProductos;
  public $subtotal;
  public $subtotalweb=0;

  public $activo;
  public $taxes   = 0;
  public $taxTotal=0;
  public $shipping = 0;
  public $totalcard = 0;
  public $cantidadinterna=0;

    protected $listeners = ['pay' => 'pay',
        'crearcliente'=>'crearcliente'];

  public function mount() {
    $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
    
    }
    public function render()
    {
    // Variables
      $this->cantidadProductos=\Cart::session(Auth()->user()->idUser)->getContent();
      // dd($this->cantidadProductos);
      $this->subtotal=\Cart::session(Auth()->user()->idUser)->getSubTotal();
      $this->user=Affiliate::where('idAffiliated',Auth()->user()->idAffiliated)->first();
      $b = $this->user;
      $STRIPE_KEY = config('services.stripe.STRIPE_KEY');
      $variable = config('services.stripe.STRIPE_SECRET');
      $this->total= \Cart::session(Auth()->user()->idUser)->getTotal();
      $totalonzas=0;
      $membresia=0;

      // $tax=$this->taxes();
      if (count($this->cantidadProductos)>0) {
            foreach ($this->cantidadProductos as $key => $value) {

              if ($value->attributes->membresia) {
                $membresia=24.95;
              }
              $totalonzas+=$value->attributes->onzas*$value->quantity;
               
              $this->taxtotal+=$value->attributes->tax;
            }
            // dd($this->taxTotal);
            $this->totalOnzas($totalonzas);  

            $this->taxes();  
            // dd($this->taxes);
            $taxsub=number_format(floatval($this->subtotal*$this->taxes/100),2);
            //  dd($taxsub);//17.07
            // number_format(floatval($this->subtotal+$taxsub*),2);
            $this->subtotalweb=$this->subtotal+$taxsub+$membresia;
            $this->totalImpuestoShipping=number_format(floatval($this->subtotalweb+$this->shipping),2); 
            return view('livewire.page-pay',compact('b','STRIPE_KEY',))->extends('layout.side-menu')->section('subcontent');
      }else{
            return view('pages/dashboard-overview-1')
            ->extends('layout.side-menu')
            ->section('subcontent');
      }

    }
    public function pay($token, $name, $total, ){

        $tok=$token;
      $variable = config('services.stripe.STRIPE_SECRET');
      $this->stripe = new \Stripe\StripeClient($variable);    
      $idAfiliado=Auth()->user()->idAffiliated;

      $this->finishpay($idAfiliado,$tok);
            
      $this->ClearCart();
      $mensaje='';
      $language=session()->get('locale');

      if ($language=='en') {
        $mensaje='successful purchase!!.';
      }else{
        $mensaje='Compra Exitosa!!';
      }
      return redirect('/products')->with('success', $mensaje);
    }

    public function finishpay($idAfiliado,$token)
    {
     
      $fechaHoraActual = Carbon::now();
      $fechaHoraMySQL = $fechaHoraActual->format('Y-m-d H:i:s');
      // dd($fechaHoraMySQL);
         $result= DB::select('CALL SpSales(?,?,?,?,?,?,?,?,?,?,?,?)', array(
            'Sale',
            $idAfiliado,
            8,//idprod
            0,//idwebsite
            $this->totalImpuestoShipping,
            'CASH',
            0,
            null,
            $fechaHoraMySQL, 
            'office',
            $this->shipping,
            0// Convertir a nulo si es una cadena vacía
        ));
      
        $idSale=$result[0]->last_inserted_id;
        $this->DetailSale($idSale,$token);
    }

    public function DetailSale($idSale,$token)
    {
      foreach ($this->cantidadProductos as $pro) {
        $subtotal=number_format(floatval($pro['price']+$pro['attributes']['tax']),2);
         $description ="Cantidad: ".$pro['quantity']. " Producto: ".$pro['name']." Subtotal: ".$subtotal."\n";

        $detailV= new DetailSale();
            $detailV->id_sale=$idSale;
            $detailV->id_product=$pro['id'];
            $detailV->NameProduct=$pro['name'];
            $detailV->precioVenta=$pro['price'];
            $detailV->Tax=$pro['attributes']['tax'];
            $detailV->cantidad=$pro['quantity'];
            $detailV->subtotal=$subtotal;
            $detailV->save();
        }
    
        $this->stripe->charges->create([
            'amount' =>number_format(floatval($this->totalImpuestoShipping),2)*100,
            'currency' => 'usd',
            'description' => $description,
            'receipt_email'=>$this->user->Email,
            'source' => $token,
          
        ]);
    }
    public function ClearCart()
    {
        \Cart::session(Auth()->user()->idUser)->clear();
        $this->cantidadProductos=\Cart::getContent()->count();
    }

     public function totalOnzas($totalonzas){
      // dd($totalonzas);
      $this->onzasblade=$totalonzas;
            if($totalonzas==0){
              return $this->shipping = 0;
            }
            if ($totalonzas < 32 ) {
              return $this->shipping = 7;
            }else{
              $shippinadd=intval($totalonzas-31);
              return $this->shipping = intval($shippinadd+7);
            }
     }
     public function taxes(){

      $state=$this->user->State;

      switch (strtoupper($state)) {
        case 'NEVADA':
           return $this->taxes=8.375;
            
          break;
        default:
           return  $this->taxes=0;
          break;
        }
     }
}
