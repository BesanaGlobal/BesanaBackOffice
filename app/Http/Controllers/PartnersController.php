<?php

namespace App\Http\Controllers;

use App\Helper\Data;
use App\Models\Affiliate;
use App\Models\Arbol;
use App\Models\RelSponsor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PartnersController extends Controller
{

    public function getChildren($id)
    {
        $children= collect();
        $children = $children->merge(DB::select('CALL sp_consultararbol(?)', array($id)));
                
        $result = [];
        foreach ($children as $child) {
            $result[] = $child;
            $result = array_merge($result, $this->getChildren($child->idSon));
        }
        
        return $result;
    }

    public function index()
    {
        try {
            $id = Auth()->user()->idAffiliated;
            $affiliateData = DB::table('affiliates')
                ->select('Email','Phone')->where('idAffiliated', $id)
                ->get();
            $father[]=array(
                'id' => $id,
                'Email' => $affiliateData[0]->Email,
                'img' => "img/LogoWhite.png",
                'tags' => ["socioactivo"],
                'User' => Auth()->user()->userName,
                'username' => Auth()->user()->userName,
                'Phone'=> $affiliateData[0]->Phone
            );

            if ($id == 1) {
                $query = DB::select('CALL sp_queryAdminTree()');
                $admin = [];
                $admin[] = array(
                    'id' => $id,
                    'Email' => $affiliateData[0]->Email,
                    'img' => "img/LogoWhite.png",
                    'tags' => ["socioactivo"],
                    'User' => Auth()->user()->userName,
                    'username' => Auth()->user()->userName,
                    'Phone'=> $affiliateData[0]->Phone
                );
                foreach ($query as  $value) {
                    switch ($value->RankName) {
                        case 'SOCIO ACTIVO':
                            array_push($admin, [
                                'id' => $value->idSon,
                                'pid' => $value->idFhater,
                                'tags' => ["socioactivo"],
                                'User' => $value->userName,
                                'img' => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                            break;
                        case 'DIRECTOR':
                            array_push($admin, [
                                'id' => $value->idSon,
                                'pid' => $value->idFhater,
                                'tags' => ["director"],
                                'User' => $value->userName,
                                'img' => "img/ranks/director.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                            break;
                    }
                }
                sleep(2);
                $datos = json_encode($admin);
                return view('pages.partner-tree', ['data' => $datos]);
            } else {
                $children = $this->getChildren($id);
                
                foreach ($children as $value) {
                    if ($value->idFhater == $id) {
                        switch ($value->RankName) {
                            case 'SOCIO ACTIVO':
                                array_push($father, [
                                    'id' => $value->idSon,
                                    'pid' => $value->idFhater,
                                    'tags' => ["socioactivo"],
                                    'User' => $value->userName,
                                    'img' => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone,
                                ]);
                                break;
                            case 'DIRECTOR':
                                array_push($father, [
                                    'id' => $value->idSon,
                                    'pid' => $value->idFhater,
                                    'tags' => ["director"],
                                    'User' => $value->userName,
                                    'img' => "img/ranks/director.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone,
                                ]);
                                break;
                        }
                    } else {
                        switch ($value->RankName) {
                            case 'SOCIO ACTIVO':
                                array_push($father, [
                                    'id' => $value->idSon,
                                    'pid' => $value->idFhater,
                                    'tags' => ["socioactivo"],
                                    'User' => $value->userName,
                                    'img' => "img/ranks/socioactivo.png",
                                    'Email' => '',
                                    'Phone' => '',
                                ]);
                                break;
                            case 'DIRECTOR':
                                array_push($father, [
                                    'id' => $value->idSon,
                                    'pid' => $value->idFhater,
                                    'tags' => ["director"],
                                    'User' => $value->userName,
                                    'img' => "img/ranks/director.png",
                                    'Email' => '',
                                    'Phone' => '',
                                ]);
                                break;
                        }
                    }
                }
                $datos = json_encode($father);
                return view('pages.partner-tree', ['data' => $datos]);
            }
        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            dd($message);
            return redirect()->back()->with('error', 'Error: ha ocurrido un error' . $message);
        }
    }
}
