<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PartnersController extends Controller
{

    public function getChildren($id)
    {
        $children   = collect();
        $children   = $children->merge(DB::select('CALL sp_consultararbol(?)', array($id)));     
        $result     = [];

        foreach ($children as $child) {
            $result[]   = $child;
            $result     = array_merge($result, $this->getChildren($child->idSon));
        }
        
        return $result;
    }

    public function index()
    {
        try {
            $id             = Auth()->user()->idAffiliated;
            $affiliateData  = DB::table('affiliates')
                ->select('Email','Phone')
                ->where('idAffiliated', $id)
                ->get();

            $father[]   = array(
                'id'        => $id,
                'Email'     => $affiliateData[0]->Email,
                'img'       => "img/LogoWhite.png",
                'tags'      => ["socioactivo"],
                'User'      => Auth()->user()->userName,
                'username'  => Auth()->user()->userName,
                'Phone'     => $affiliateData[0]->Phone
            );

            if ($id == 1) {
                $query      = DB::select('CALL sp_queryAdminTree()');
                $admin      = [];
                $admin[]    = array(
                    'id'        => $id,
                    'Email'     => $affiliateData[0]->Email,
                    'img'       => "img/LogoWhite.png",
                    'tags'      => ["socioactivo"],
                    'User'      => Auth()->user()->userName,
                    'username'  => Auth()->user()->userName,
                    'Phone'     => $affiliateData[0]->Phone
                );
                foreach ($query as  $value) {
                    switch ($value->RankName) {
                        case 'SOCIO PROMOTOR':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["sociopromotor"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'ASOCIADO':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["asociado"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'SOCIO ACTIVO':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["socioactivo"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'DIRECTOR':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["director"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'JADE':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["jade"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'SAFIRO':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["safiro"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'SAFIRO AZUL':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["safiroazul"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'RUBÍ':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["rubi"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'ESMERALDA':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["esmeralda"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'DIAMANTE':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["diamante"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'DIAMANTE AZUL':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["diamanteazul"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                        case 'DIAMANTE CORONA':
                            array_push($admin, [
                                'id'    => $value->idSon,
                                'pid'   => $value->idFhater,
                                'tags'  => ["diamantecorona"],
                                'User'  => $value->userName,
                                'img'   => "img/ranks/socioactivo.png",
                                'Email' => $value->Email,
                                'Phone' => $value->Phone
                            ]);
                        break;
                    }
                }
                sleep(2);
                $datos      = json_encode($admin);

                return view('pages.partner-tree', ['data' => $datos]);
            } else {
                $children   = $this->getChildren($id);
                
                foreach ($children as $value) {
                    if ($value->idFhater == $id) {
                        switch ($value->RankName) {
                            case 'SOCIO PROMOTOR':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["sociopromotor"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'ASOCIADO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["asociado"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'SOCIO ACTIVO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["socioactivo"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'DIRECTOR':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["director"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'JADE':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["jade"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'SAFIRO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["safiro"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'SAFIRO AZUL':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["safiroazul"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'RUBÍ':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["rubi"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'ESMERALDA':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["esmeralda"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'DIAMANTE':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamante"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'DIAMANTE AZUL':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamanteazul"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                            case 'DIAMANTE CORONA':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamantecorona"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => $value->Email,
                                    'Phone' => $value->Phone
                                ]);
                            break;
                        }
                    } else {
                        switch ($value->RankName) {
                            case 'SOCIO PROMOTOR':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["sociopromotor"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'ASOCIADO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["asociado"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'SOCIO ACTIVO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["socioactivo"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'DIRECTOR':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["director"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'JADE':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["jade"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'SAFIRO':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["safiro"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'SAFIRO AZUL':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["safiroazul"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'RUBÍ':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["rubi"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'ESMERALDA':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["esmeralda"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'DIAMANTE':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamante"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'DIAMANTE AZUL':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamanteazul"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                            case 'DIAMANTE CORONA':
                                array_push($father, [
                                    'id'    => $value->idSon,
                                    'pid'   => $value->idFhater,
                                    'tags'  => ["diamantecorona"],
                                    'User'  => $value->userName,
                                    'img'   => "img/ranks/socioactivo.png",
                                    'Email' => "",
                                    'Phone' => ""
                                ]);
                            break;
                        }
                    }
                }
                $datos  = json_encode($father);
                return view('pages.partner-tree', ['data' => $datos]);
            }
        } catch (\Exception $e) {
            
            $message = $e->getMessage();
            return redirect()->back()->with('error', 'Error: ha ocurrido un error' . $message);
        }
    }
}
