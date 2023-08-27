<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\DetailSale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function Buy(Request $request)
    {
        //VARIABLES
        $objeto             = $request->json()->all();
        $userName           = $objeto['user']['userName'];
        $state              = $objeto['user']['state'];        
        $email              = $objeto['user']['email'];
        $Products           = $objeto['producDetail'];
        $total              = $request->total;
        $shipping           = $request->shipping;
        $tokenCard          = $request->tokenCard;
        $variable           = config('services.stripe.STRIPE_SECRET');
        $fechaHoraActual    = Carbon::now();
        $idAfiliado         = User::where('userName',$userName)->first();
        //se obtiene el id del user
        $id             = intval($idAfiliado->idAffiliated);  
        $fechaHoraMySQL = $fechaHoraActual->format('Y-m-d H:i:s');
        //SE INSERTA LA COMPRA EN LA BASE DE DATOS.
        $result= DB::select('CALL SpSales(?,?,?,?,?,?,?,?,?,?,?,?)', 
            array(
                'Sale',
                $id,
                8,//IDPROD
                0,//IDWEBSITE
                $total,
                'CASH',
                0,
                null,
                $fechaHoraMySQL, 
                'website',
                $shipping,
                0// Convertir a nulo si es una cadena vacía
            )
        );
   
        //OBTENER EL TAX SEGUN EL ESTADO
        foreach($Products as  $value){
            //CREAMOS EL DETALLE DE LA VENTA
            $subtotal=($value['price']+$value['taxProduct']);
            $description ="Cantidad: ".$value['quantityProduct']. " Producto: ".$value['nameProduct']." Subtotal: "."\n";
            $detailV= new DetailSale();
            $detailV->id_sale=$result[0]->last_inserted_id;
            $detailV->id_product=$value['idProduct'];
            $detailV->NameProduct=$value['nameProduct'];
            $detailV->precioVenta=$value['price'];
            $detailV->cantidad=$value['quantityProduct'];
            $detailV->Tax=$value['taxProduct'];
            $detailV->subtotal=$subtotal;

            $detailV->save();
        }
   
        //crear el cargo en stripe
        $stripe = new \Stripe\StripeClient($variable);
        $stripe->charges->create([
            'amount' => $total*100,
            'currency' => 'usd',
            'description' => $description,
            'receipt_email'=>$email,
            'source' => $tokenCard,
        ]);

        return response()->json(['data'=>$stripe]);

    }

    public function Sponsor(Request $sponsor)
    {
        $data=json_decode($sponsor);
        $idAfiliado=User::where('userName',$sponsor->sponsor)->get();
        
        if ($idAfiliado->isEmpty()) {
            return response()->json(['mensaje' => 'no','idafiliado'=>$idAfiliado,'data'=>$sponsor->sponsor]);
        }
        return response()->json(['mensaje' => 'yes','data'=>$sponsor->sponsor]);
        // return response()->json(['error' => 'Registro no encontrado'], 404);

    }
}
