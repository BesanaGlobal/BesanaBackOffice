@extends('../layout/' . $layout)

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
                        <!-- BEGIN: Modal Toggle -->
                            <div class="text-right ml-4">
                                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#basic-modal-preview" class="btn btn-sm btn-outline-primary btn-lg">{{__('My link')}}</a>
                            </div>
                        <!-- END: Modal Toggle -->
                        <!-- BEGIN: Modal Content -->
                            <div id="basic-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-10 text-center">
                                            <h2>{{__('Link')}}</h2>
                                            <input id="regular-form-5" type="text" class="form-control" value="{{$website->webSite}}" placeholder="Mi link" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- END: Modal Content -->
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
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8 mb-2">
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

                <!-- Wallet  -->
                <div class="col-span-12 lg:col-span-6 ">
                    <div class="intro-y flex-auto items-center">
                        <div class="col-span-12 sm:col-span-12 xl:col-span-12 lg:col-span-6 intro-y">
                            <div class="report-box">
                                <div class="box p-5">
                                    <div class="flex justify-around">
                                        <img src="{{asset('svg/wallet.svg')}}" alt="wallet" class="object-contain w-10 h-10">
                                        <span class="uppercase font-extrabold text-lg py-2">{{__('Wallet')}}</span>
                                    </div>
                                    <div class="table-responsive">
                                            <table class="table-auto" width="100%">
                                                <thead class="">
                                                    <tr class="text-center">
                                                    <th class=" bg-primary text-white">{{__('Payments')}}</th>
                                                    <th class=" bg-primary text-white">{{__('Amount')}}</th>
                                                    <th class=" bg-primary text-white">Forma de Pago</th>
                                                    <th class=" bg-primary text-white">{{__('Actions')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="p-2">
                                                            <span class="bg-orange-600 text-white  px-3">{{__('Weekly')}}</span>
                                                        </td>
                                                        @if (count($walletWeek)>0)
                                                            @php
                                                                $sumTotalWeek = 0;
                                                                foreach($walletWeek as $value){
                                                                    $sumTotalWeek += $value->total;
                                                                }
                                                            @endphp
                                                            <td class="text-center py-2">  
                                                                <span class="font-bold text-orange-600">$ {{ $sumTotalWeek }} </span>
                                                            </td>
                                                            <form action="{{route('solicitaWeek')}}" method="POST" >
                                                                @csrf
                                                                <td class="text-center py-2">  
                                                                @if($afiliado->BankAccount == null && $afiliado->RoutingNumber == null && $afiliado->TypeAccount == null)
                                                                    <select name="tPago" id="tPago">
                                                                        <option value="Cheque">Cheque</option>
                                                                    </select>
                                                                @else
                                                                    <select name="tPago" id="tPago">
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Transferencia">Transferencia</option>
                                                                    </select>
                                                                @endif
                                                                </td>
                                                                <td class="text-center p-2">  
                                                                    <input type="hidden" name="id" value="{{$walletWeek[0]->id_user}}">
                                                                    <button class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-1 px-2 rounded">
                                                                        {{__('Request')}}
                                                                    </button>
                                                                </td>
                                                            </form>
                                                        @else
                                                            <td class="text-center">{{__('No Wallet')}}</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"></td>
                                                        @endif
                                                    </tr>
                                                    {{-- MENSUAL --}}
                                                    <tr>
                                                        <td class="p-2">
                                                            <span class="bg-green-700 text-white  px-3">{{__('Monthly')}}</span>
                                                        </td>
                                                        @if(count($walletMonth)>0)
                                                            @php
                                                                $sumTotalMonth = 0;
                                                                foreach($walletMonth as $value){
                                                                    $sumTotalMonth += $value->total;
                                                                }
                                                            @endphp
                                                            <td class="text-center py-2">  
                                                                <span class="font-bold text-orange-600">$ {{ $sumTotalMonth }} </span>
                                                            </td>
                                                            <form action="{{route('solicitaMonth')}}" method="POST" >
                                                                @csrf
                                                                <td class="border text-center py-2">
                                                                @if($afiliado->BankAccount == null && $afiliado->RoutingNumber == null && $afiliado->TypeAccount == null)
                                                                    <select name="tPago" id="tPago">
                                                                        <option value="Cheque">Cheque</option>
                                                                    </select>
                                                                @else
                                                                    <select name="tPago" id="tPago">
                                                                        <option value="Cheque">Cheque</option>
                                                                        <option value="Transferencia">Transferencia</option>
                                                                    </select>
                                                                @endif
                                                                </td>
                                                                <td class="text-center p-2">  
                                                                    <input type="hidden" name="id" value="{{$walletMonth[0]->id_user}}">
                                                                    <button class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-1 px-2 rounded">
                                                                        {{__('Claim')}}
                                                                    </button>
                                                                </td>
                                                            </form>
                                                        @else
                                                            <td class="text-center">{{__('No Wallet')}}</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"></td>
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
                <!-- End Wallet -->

            </div>
        </div>
    </div>
@endsection