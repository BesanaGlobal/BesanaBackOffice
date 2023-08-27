<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use App\Models\WalletMonth;
use App\Models\WalletWeek;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    
    public function index(){
        $data = Affiliate::select(['idAffiliated', 'Name'])->get();
        
        
        return view('afiliados.listar',compact('data'));

    }

    public function edit($id)
    {
        $data = Affiliate::select(['idAffiliated', 'Name'])->where('idAffiliated',$id)->get();
        $username=User::where('idAffiliated',$id)->get();
        // dd($username);
        return view('wallet.xindex',['data'=>$data,'username'=>$username]);
    }

    public function Week(Request $request){

       
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required',
            'cantidad'=>'required'
        ],[
            'start.required'=>'Ingrese una fecha de inicio',
            'end.required'=>'Ingrese una fecha final',
            'cantidad.required'=>'Ingrese una cantidad',
        ]);

        // dd($request->idaw);

        $walletW = new WalletWeek();
        $walletW->id_user=$request->idaw;
        $walletW->fechaInicio=$request->start;
        $walletW->FechaFin=$request->end;
        $walletW->total=$request->cantidad;
        $walletW->estado='pendiente';
        $walletW->save();

        // Almacenar un mensaje de sesión de éxito
            session()->flash('success', '¡Pago de Wallet de la semana agregado!');

            // Regresar a la misma vista con el mensaje de éxito
            return back();
    }

    public function Month(Request $request){
        $this->validate($request, [
            'startM' => 'required',
            'endM' => 'required',
            'cantidadM'=>'required'
        ],[
            'startM.required'=>'Ingrese una fecha de inicio',
            'endM.required'=>'Ingrese una fecha final',
            'cantidadM.required'=>'Ingrese una cantidad',
        ]);
        $walletM = new WalletMonth();
        $walletM->id_user=$request->idam;
        $walletM->fechaInicio=$request->startM;
        $walletM->FechaFin=$request->endM;
        $walletM->total=$request->cantidadM;
        $walletM->estado='pendiente';
        $walletM->save();

        session()->flash('success', '¡Pago de Wallet del Mes agregado!');

        // Regresar a la misma vista con el mensaje de éxito
        return back();
    }

    public function walletRequest(){

        $walletMonth=WalletMonth::all();

        return view('wallet.walletRequest');
    }

    public function WeekList(){
        $walletWeek=WalletWeek::all();
        return view('wallet.weeklist', compact('walletWeek'));

    }
    public function MonthList(){
        $walletMonth=WalletMonth::all();
        // dd($walletMonth);
        return view('wallet.monthlist', compact('walletMonth'));

    }

    public function btnAprobarWeek(Request $request){
        $wallet=WalletWeek::findOrFail($request->id);
        $wallet->estado='aprobado';
        $wallet->save();

        session()->flash('success', '¡La información se ha procesado correctamente!');

        // Regresar a la misma vista con el mensaje de éxito
        return back();
    }

}
