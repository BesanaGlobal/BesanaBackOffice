@extends('../layout/' . $layout)

@section('subhead')
    <title>Mis clientes | BesanaGlobal</title>
@endsection

@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">Mis compras</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">Buy now</button>
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
                                <i data-lucide="users" class="w-4 h-4 mr-2"></i> Add Group
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i> Send Message
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
                            <p class="text-center">Sin compras en la oficina en estos momentos</p>        
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
                            <div class="text-slate-500 text-xs mt-0.5">Puntos adquiridos mediante la oficina: <strong>{{ $value['pointsOffice'] }} Pts.</strong></div>
                            <div class="text-slate-500 text-xs mt-0.5">Momento de la compra: <strong>{{ $value['dateTimeb'] }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif  
    </div>
    <h2 class="intro-y text-lg font-medium mt-10">Mis clientes</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">Add New Client</button>
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
                                <i data-lucide="users" class="w-4 h-4 mr-2"></i> Add Group
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i> Send Message
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
                           <p class="text-center">Sin clientes en estos momentos</p>        
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
                                <div class="text-slate-500 text-xs mt-0.5">Puntos adquiridos mediante el website: {{ $client['pointsWebsite'] }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">Momento de la compra: {{ $client['dateTimeb'] }}</div>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                <button class="btn btn-primary py-1 px-2 mr-2">Message</button>
                                <button class="btn btn-outline-secondary py-1 px-2">Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
