@extends('../layout/' . $layout)
@section('subhead')
    <title>Dashboard - Besana</title>
@endsection
@section('subcontent')
    <div>
        <!-- Wallet  -->
            <div class="col-span-12 lg:col-span-6 mt-5">
                <div class="intro-y flex-auto items-center">
                    <div class="col-span-12 sm:col-span-12 xl:col-span-12 lg:col-span-6 intro-y">
                        <div class="report-box">
                            <div class="box p-5">
                                <div class="flex justify-between mb-3">
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
                                                        <span class="font-bold text-orange-600">{{ number_format($sumTotalWeek,2) }} </span>
                                                    </td>
                                                    <form action="{{route('solicitaWeek')}}" method="POST" >
                                                        @csrf
                                                        <td class="text-center py-2">  
                                                        @if($afiliado->BankName == null && $afiliado->BankAccount == null && $afiliado->RoutingNumber == null && $afiliado->TypeAccount == null)
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Wallet -->
    </div>
@endsection

