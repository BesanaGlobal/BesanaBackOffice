@extends('../layout/' . $layout)

@section('subhead')
    <title>{{__('List of Promoter Partners')}}| BesanaGlobal</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">{{__('MY PROMOTOR PARTNERS')}}</h2>
    <div class="grid grid-cols-12 gap-1 mt-5">
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
                    <div class="text-base text-slate-500 mt-1">{{__('Promotor partners volume')}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex justify-end sm:flex-nowrap items-center mt-2">
            {{-- <button class="btn btn-primary shadow-md mr-2">Add New Product</button> --}}
            <!-- <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> {{__('Print')}}
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> {{__('Export to Excel')}}
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> {{__('Export to PDF')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div> -->
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="{{__('Search')}}...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ID</th>
                        <th class="text-center whitespace-nowrap">{{__('Users')}}</th>
                        <th class="text-center whitespace-nowrap">{{__('Email')}}</th>
                        <th class="text-center whitespace-nowrap">{{__('Phone')}}</th>
                        <th class="text-center whitespace-nowrap">{{__('Client volume')}}</th>
                        <th class="text-center whitespace-nowrap">{{__('State')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($activePromoters) < 1)
                        <tr class="intro-x">
                            <td class="w-40"> - </td>
                            <td> - </td>
                            <td class="text-center"> - </td>
                            <td class="text-center"> - </td>
                            <td class="text-center"> - </td>
                            <td class="text-center"> - </td>
                        </tr>
                    @else
                        @foreach ($activePromoters as $key => $value)
                            <tr class="intro-x">
                                <td class="w-40">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $value['name'] }}</td>
                                <td class="text-center">{{ $value['email'] }}</td>
                                <td class="text-center">{{ $value['phone'] }}</td>
                                <td class="text-center">{{ $value['totalPoints'] }} Pts. Web</td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center {{ $value['active'] == '1' ? 'text-success' : 'text-danger' }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $value['active'] == '1'  ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <!-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div> -->
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <!-- <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- END: Delete Confirmation Modal -->
@endsection
