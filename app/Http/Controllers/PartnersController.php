<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use App\Models\Affiliate;
use App\Models\Arbol;
use App\Models\RelSponsor;
use App\Models\User;
use DB;

use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        try {
                $id = Auth()->user()->idAffiliated;
                
              
                $Email= DB::table('affiliates')
                ->select('Email')->where('idAffiliated',$id)
                ->get();
              
                $fhater[]=array(
                    'id'=>$id,
                    'Email'=>$Email[0]->Email,
                    'img'=>"img/LogoWhite.png",
                    'tags'=> ["socioactivo"],
                    'User'=>Auth()->user()->userName,
                    'username'=>Auth()->user()->userName,

                );
                if ($id==1) {
                    $query= DB::select('CALL sp_queryAdminTree()');
                    //  dd($query);
                    $admin=[];
                    $admin[]=array(
                        'id'=>$id,
                        'Email'=>$Email[0]->Email,
                        'img'=>"img/LogoWhite.png",
                        'tags'=> ["socioactivo"],
                        'User'=>Auth()->user()->userName,
                        'username'=>Auth()->user()->userName,
    
                    );
                    foreach ($query as  $value) {
                        switch ($value->RankName) {
                            case 'SOCIO ACTIVO':
                                array_push($admin, [
                                    'id'=>$value->idSon,
                                    'pid'=>$value->idFhater,
                                     'tags'=> ["socioactivo"],             
                                   'User'=>$value->userName,
                                 'img'=>"img/ranks/socioactivo.png",
                                ]);
                            break;
                            case 'DIRECTOR':
                                array_push($admin, [
                                    'id'=>$value->idSon,
                                    'pid'=>$value->idFhater,
                                     'tags'=> ["director"],             
                                   'User'=>$value->userName,
                                 'img'=>"img/ranks/director.png",
                                ]);
                            break;
                        }
                    }
                    //  dd($admin);
                    sleep(2);
                    $datos = json_encode($admin);
                    return view('pages.partner-tree',['data'=> $datos]);
                }else{
                    $query= DB::select('CALL sp_consultararbol(?)', array(
                        $id
                    ));
                    $cantidad=count($query);
                   
                    if ($cantidad >=1) {
                        foreach ($query as  $value) {
                            switch ($value->RankName) {
                                case 'SOCIO ACTIVO':
                                    array_push($fhater, [
                                        'id'=>$value->idSon,
                                        'pid'=>$value->idFhater,
                                         'tags'=> ["socioactivo"],             
                                       'User'=>$value->userName,
                                     'img'=>"img/ranks/socioactivo.png",
                                    ]);
                                break;
                            }
                        }

                    }


                        // dd($fhater);
                        $datos = json_encode($fhater);
                        return view('pages.partner-tree',['data'=> $datos]);
                    
                    

             
                   
                }
            //     $newdata=array_merge($fhater, $query);
         
            //     $datos = json_encode($newdata);
                
            //     dd($query);
            //  return view('pages.partner-tree',['data'=> $datos]);

        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error','Error: ha ocurrido un error'. $message); 
        }
     

    }
}
