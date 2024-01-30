<?php

namespace App\Main;

use Illuminate\Support\Facades\Auth;
use App\Models\Affiliate;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        if (!Auth()->user()) {
            return [];
        }else{
            $user = Auth()->user();
            $afiliado = Affiliate::where('idAffiliated', $user->idAffiliated)->with('rank')->get();
            if (Auth()->user()->active) {   
                if(Auth()->user()->idUser == 1){
                    return[
                        'dashboard' => [
                            'icon' => 'home',
                            'title' => 'Home',
                            'route_name' => 'dash',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],
                        'devider',
                        'Shipping' => [
                            'icon' => 'box',
                            'route_name' => 'shipping',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Shipping'
                        ],
                        'devider',
                        'Shop' => [
                            'icon' => 'shopping-cart',
                            'route_name' => 'products',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Shop'
                        ],
                        'Compras' => [
                            'icon' => 'shopping-cart',
                            'route_name' => 'myshops',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'My shopping'
                        ],
                        'devider',
                        'Agregar-afiliado' => [
                            'icon' => 'plus-circle',
                            'route_name' => 'socioactivo',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Add affiliate'
                        ],
                        'Socios-Activos' => [
                            'icon' => 'users',
                            'route_name' => 'active-partners',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Active Member'
                        ],
                        'Socios-Promotores' => [
                            'icon' => 'user-check',
                            'route_name' => 'sociospromotores',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Promoter Partner'
                        ],
                        
                        'Clientes' => [
                            'icon' => 'user-plus',
                            'route_name' => 'users-layout-2',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Customers'
                        ],
                        // 'Prospectos' => [
                        //     'icon' => 'user-plus',
                        //     'route_name' => 'users-layout-3',
                        //     'params' => [
                        //         'layout' => 'side-menu'
                        //     ],
                        //     'title' => 'Prospects'
                        // ],
                        'devider',
                        'Wallet' => [
                            'icon' => 'dollar-sign',
                            'route_name' => 'wallet',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Wallet'
                        ],
                        'devider',
                        'Centroderecursos' => [
                            'icon' => 'database',
                            'route_name' => 'file-manager',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Resource Center'
                        ],
                        'Listar-afiliados' => [
                            'icon' => 'list',
                            'route_name' => 'ListUsers',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Affiliate List'
                        ],
                        'Tree' => [
                            'icon' => 'user',
                            'route_name' => 'partnertree',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Genealogy'
                        ],
                        'devider',
                        'Products' => [
                            'icon' => 'user',
                            'route_name' => 'productsData',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Products'
                        ],
                    ];
                };
                //SI NO ES MASTER
                if ($afiliado[0]->rank->RankName == "SOCIO PROMOTOR") {
                    return [
                        'dashboard' => [
                            'icon' => 'home',
                            'title' => 'Home',
                            'route_name' => 'dash',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                        ],
                        'devider',
                        'Clientes' => [
                            'icon' => 'user-plus',
                            'route_name' => 'users-layout-2',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Customers'
                        ],
                        'devider',
                        'Wallet' => [
                            'icon' => 'dollar-sign',
                            'route_name' => 'wallet',
                            'params' => [
                                'layout' => 'side-menu'
                            ],
                            'title' => 'Wallet'
                        ],
                    ];
                }
                return [
                    'dashboard' => [
                        'icon' => 'home',
                        'title' => 'Home',
                        'route_name' => 'dash',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    'devider',
                    'Shop' => [
                        'icon' => 'shopping-cart',
                        'route_name' => 'products',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Shop'
                    ],
                    'Compras' => [
                        'icon' => 'shopping-cart',
                        'route_name' => 'myshops',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'My shopping'
                    ],
                    'devider',
                    'Agregar-afiliado' => [
                        'icon' => 'plus-circle',
                        'route_name' => 'socioactivo',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Add affiliate'
                    ],
                    'Socios-Activos' => [
                        'icon' => 'users',
                        'route_name' => 'active-partners',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Active Member'
                    ],
                    'Socios-Promotores' => [
                        'icon' => 'user-check',
                        'route_name' => 'sociospromotores',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Promoter Partner'
                    ],
                    
                    'Clientes' => [
                        'icon' => 'user-plus',
                        'route_name' => 'users-layout-2',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Customers'
                    ],
                    'devider',
                    'Wallet' => [
                        'icon' => 'dollar-sign',
                        'route_name' => 'wallet',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Wallet'
                    ],
                    'devider',
                    'Centroderecursos' => [
                        'icon' => 'database',
                        'route_name' => 'file-manager',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Resource Center'
                    ],
                    'Listar-afiliados' => [
                        'icon' => 'list',
                        'route_name' => 'ListUsers',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Affiliate List'
                    ],
                    'Tree' => [
                        'icon' => 'user',
                        'route_name' => 'partnertree',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                        'title' => 'Genealogy'
                    ],
                    'devider',
                ];
            }else{
                return [];
            }
            
        }
    }
}
