@extends('../layout/' . $layout)

@section('subhead')
    <title>{{__('My Clients')}} | BesanaGlobal</title>
@endsection

@section('subcontent')

    <div class="grid grid-cols-12 gap-1 mt-5">
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
                    <div class="text-base text-slate-500 mt-1">{{__('CUSTOMER VOLUME')}}</div>
                </div>
            </div>
        </div>
    </div>


    <h2 class="intro-y text-lg font-medium mt-10">{{__('My Shops')}}</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">{{__('Buy Now')}}</button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="users" class="w-4 h-4 mr-2"></i> {{__('Add Group')}}
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>{{__('Send Message')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if(count($office) < 1 )
            <div class="intro-y col-span-12 md:col-span-4">
                <div class="box">
                    <div class="flex-col lg:flex-row items-center p-5 d-flex justify-content-center">
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-center mt-3 lg:mt-0">
                            <p class="text-center">{{__('No purchases in the office at this time')}}</p>        
                        </div>
                    </div>
                </div>
            </div>
        @else
        @foreach($office as $value)
            <div class="intro-y col-span-12 md:col-span-3">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" class="w-12 h-12 text-gray-500">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 00-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 01-.189-.866c0-.298.059-.605.189-.866zm2.023 6.828a.75.75 0 10-1.06-1.06 3.75 3.75 0 01-5.304 0 .75.75 0 00-1.06 1.06 5.25 5.25 0 007.424 0z" clip-rule="evenodd" />
                            </svg>    
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <div class="text-slate-500 text-xs mt-0.5">{{__('Points acquired through the office')}}: <strong>{{ $value['totalPoints'] }} Pts.</strong></div>
                            <div class="text-slate-500 text-xs mt-0.5">{{__('Time of purchase')}}: <strong>{{ $value['date'] }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif  
    </div>
    <h2 class="intro-y text-lg font-medium mt-10">{{__('My Clients')}}</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">{{__('Add New Client')}}</button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="users" class="w-4 h-4 mr-2"></i>{{__('Add Group')}}
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>{{__('Send message')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if(count($clients) < 1 )
            <div class="intro-y col-span-12 md:col-span-12">
                <div class="box">
                    <div class="flex-col lg:flex-row items-center p-5 d-flex justify-content-center">
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-center mt-3 lg:mt-0">
                           <p class="text-center">{{__('No clients at this time')}}</p>        
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach ($clients as $client)
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" class="w-12 h-12 text-gray-500">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 00-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 01-.189-.866c0-.298.059-.605.189-.866zm2.023 6.828a.75.75 0 10-1.06-1.06 3.75 3.75 0 01-5.304 0 .75.75 0 00-1.06 1.06 5.25 5.25 0 007.424 0z" clip-rule="evenodd" />
                                </svg>    
                            </div>
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <a href="" class="font-medium">{{ $client['name'] }}</a>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $client['email'] }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">Puntos adquiridos mediante el website: {{ $client['totalPoints'] }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">Momento de la compra: {{ $client['date'] }}</div>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                <button class="btn btn-primary py-1 px-2 mr-2">{{__('Message')}}</button>
                                <button class="btn btn-outline-secondary py-1 px-2">{{__('Profile')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
