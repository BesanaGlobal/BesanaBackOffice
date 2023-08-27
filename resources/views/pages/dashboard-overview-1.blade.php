@extends('../layout/basenew')

@section('subhead')
    <title>Dashboard - Besana</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-10 gap-6">
        <div class="col-span-12 2xl:col-span-10">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Informe General</h2>
                        @if (session('success'))
                            <div class="alert alert-success text-white">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger text-white">
                                {{ session('danger') }}
                            </div>
                        @endif
                        @if ($afiliado->idAffiliated==1)
                            <a href="{{route('walletRequest')}}" class="btn btn-sm btn-primary"> {{__('Request')}}</a>
                        @endif
                    </div>
                    <div class="grid grid-cols-12 gap-1 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <img src="{{asset('svg/socioactivo.svg')}}" alt="cliente" class="object-fit w-14 h-14">
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month">
                                                33% <i data-lucide="chevron-up" class="object-contain w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-2">{{$totalPointsActive}}  Pts.</div>
                                    <div class="text-base text-slate-500 mt-1">Volumen de Socios Activos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <img src="{{asset('svg/promotores.svg')}}" alt="cliente" class=" object-fit w-14 h-14">
                
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month">
                                                2% <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-2">{{$totalPointsPromoters}}  Pts.</div>
                                    <div class="text-base text-slate-500 mt-1">Volumen de Socios Promotores</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <img src="{{asset('svg/clientes.svg')}}" alt="cliente" class="object-fit w-20 h-14 ">
                
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month">
                                                12% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-2">{{$totalPoints}} Pts.</div>
                                    <div class="text-base text-slate-500 mt-1">Volumen de Clientes</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box">
                                <div class="box p-5">
                                    <div class="flex justify-around">
                                        <img src="{{asset('svg/wallet.svg')}}" alt="wallet" class="object-contain w-10 h-10">
                                        <span class="uppercase font-extrabold text-lg py-2">{{__('Wallet')}}</span>
                                    </div>
                                    <div class="justify-between">
                                        {{-- @if ($walletWeek[0]->estado=='solicitado')
                                            <span class="bg-yellow-500 p-2">{{__('processing')}}</span>
                                        @elseif ($walletWeek[0]->estado=='aprobado')
                                            <span class="bg-yellow-500 p-2">{{__('Transfer sent')}}</span>
                                        @elseif($walletWeek[0]->estado=='pendiente') --}}
                                            <table class="table table-sm table-borderless table-responsive">
                                                <thead class="">
                                                    <tr class="text-center">
                                                    <th class="px-5 py-2 bg-primary text-white">{{__('Payments')}}</th>
                                                    <th class="px-5 py-2 bg-primary text-white">{{__('Amount')}}</th>
                                                    <th class="px-5 py-2 bg-primary text-white">{{__('Actions')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <tr>
                                                        <td class="p-2">
                                                            <span class="bg-orange-600 text-white  px-3">{{__('Weekly')}}</span>
                                                        </td>
                                                        @if (count($walletWeek)>0)
                                                            <td class="text-center py-2">  
                                                                <span class="font-bold text-orange-600  ">$ 
                                                                    @if ($walletWeek[0]->estado=='aprobado')
                                                                        0
                                                                    @else
                                                                        {{round($walletWeek[0]->total, 2)}}
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td class="text-center p-2">    
                                                                {{-- {{$walletMonth[0]->estado}}                                                 --}}
                                                                @if ($walletWeek[0]->estado=='solicitado')
                                                                    <span class="text-lg font-extrabold">{{__('Transaction in progress')}}</span>  
                                                                @elseif ($walletWeek[0]->estado=='aprobado')
                                                                    <span class="text-lg font-extrabold">{{__('Approved')}}</span>  
                                                                @else
                                                                    <form action="{{route('solicitaWeek')}}" method="POST" >
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{$walletWeek[0]->id}}">
                                                                        <button class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-1 px-2 rounded">
                                                                            {{__('Request')}}
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="text-center">{{__('No Wallet')}}</td>
                                                        @endif
                                                    </tr>
                                                    {{-- MENSUAL --}}
                                                    <tr>
                                                        <td class="p-2">
                                                            <span class="bg-green-700 text-white  px-3">{{__('Monthly')}}</span>
                                                        </td>
                                                        @if(count($walletMonth)>0)
                                                            <td class="border text-center py-2">
                                                                <span class="font-bold text-orange-600 ">$ {{round($walletMonth[0]->total, 2)}}</span>
                                                            </td>
                                                            <td class="border text-center p-2">                                                    
                                                                @if($walletMonth[0]->estado=='solicitado'||$walletMonth[0]->estado=='pendiente')
                                                                    <span class="text-lg font-extrabold">{{__('Request')}}</span>  
                                                                @else
                                                                    <form action="{{route('solicitaMonth')}}" method="POST" >
                                                                        csrf
                                                                        <input type="hidden" name="id" value="{{$walletMonth[0]->id}}">
                                                                        <button class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-1 px-2 rounded">
                                                                            {{__('Claim')}}
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="text-center">{{__('No Wallet')}}</td>
                                                        @endif
                                                    </tr>       
                                                </tbody>
                                            </table>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 lg:col-span-6 mt-8">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                        <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                            <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                            <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                        </div>
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex">
                                <div>
                                    <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">$15,000</div>
                                    <div class="mt-0.5 text-slate-500">This Month</div>
                                </div>
                                <div class="w-px h-12 border border-r border-dashed border-slate-200 dark:border-darkmode-300 mx-4 xl:mx-5"></div>
                                <div>
                                    <div class="text-slate-500 text-lg xl:text-xl font-medium">$10,000</div>
                                    <div class="mt-0.5 text-slate-500">Last Month</div>
                                </div>
                            </div>
                            <div class="dropdown md:ml-auto mt-5 md:mt-0">
                                <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false" data-tw-toggle="dropdown">
                                    Filter by Category <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
                                </button>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content overflow-y-auto h-32">
                                        <li><a href="" class="dropdown-item">PC & Laptop</a></li>
                                        <li><a href="" class="dropdown-item">Smartphone</a></li>
                                        <li><a href="" class="dropdown-item">Electronic</a></li>
                                        <li><a href="" class="dropdown-item">Photography</a></li>
                                        <li><a href="" class="dropdown-item">Sport</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="report-chart">
                            <div class="h-[275px]">
                                <canvas id="report-line-chart" class="mt-6 -mb-6"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
                <!-- BEGIN: Weekly Top Seller -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Weekly Top Seller</h2>
                        <a href="" class="ml-auto text-primary truncate">Show More</a>
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <div class="mt-3">
                            <div class="h-[213px]">
                                <canvas id="report-pie-chart"></canvas>
                            </div>
                        </div>
                        <div class="w-52 sm:w-auto mx-auto mt-8">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                <span class="truncate">17 - 30 Years old</span>
                                <span class="font-medium ml-auto">62%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                <span class="truncate">31 - 50 Years old</span>
                                <span class="font-medium ml-auto">33%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                <span class="truncate">>= 50 Years old</span>
                                <span class="font-medium ml-auto">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Weekly Top Seller -->
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                        <a href="" class="ml-auto text-primary truncate">Show More</a>
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <div class="mt-3">
                            <div class="h-[213px]">
                                <canvas id="report-donut-chart"></canvas>
                            </div>
                        </div>
                        <div class="w-52 sm:w-auto mx-auto mt-8">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                <span class="truncate">17 - 30 Years old</span>
                                <span class="font-medium ml-auto">62%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                <span class="truncate">31 - 50 Years old</span>
                                <span class="font-medium ml-auto">33%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                <span class="truncate">>= 50 Years old</span>
                                <span class="font-medium ml-auto">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
            </div>
        </div>
    </div>
@endsection
