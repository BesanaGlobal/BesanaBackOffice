@extends('../layout/' . $layout)

@section('subhead')

@endsection

@section('subcontent')
 <div class="card">
    @php
        $readonly='readonly';
        if(auth()->user()->userName=='BesanaMaster')
              $readonly='';
        
    @endphp
    
     <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl p-3">
        <div class="md:flex">
          <div class="md:w-1/2">
            <h1 class="text-white text-xl font-bold bg-primary  px-2 uppercase">{{__('personal information')}}</h1>
           
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                  {{__('Name')}}
                </label>
                <input {{$readonly}} class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->Name}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                  {{__('Last Name')}}
                </label>
                <input {{$readonly}} class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->LastName}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                  {{__('Enter your SSN')}}
                </label>
                <input {{$readonly}} class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->SSN}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                  {{__('Birthday')}}
                </label>
                <input {{$readonly}} type="date" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->DateBirth}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                  {{__('Username')}}
                </label>
                <input {{$readonly}} type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->userName}}">
            </div>
          </div>
          <div class="ml-3 bg-gray-200 md:w-1/2 px-2">
            <h1 class="text-white text-xl font-bold bg-primary  px-2 uppercase">{{__('Contact Information')}}</h1>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                  {{__('Email')}}
                </label>
                <input {{$readonly}} type="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->Email}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                  {{__('Phone')}}
                </label>
                <input {{$readonly}} type="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->Phone}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                  {{__('Address')}}
                </label>
                <input {{$readonly}} type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->Address}}">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="Email">
                  {{__('Address')}}
                </label>
                <input {{$readonly}} type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" value="{{$Af[0]->Country}}">
            </div>

            
          </div>
        </div>
      </div>
      
 </div>
@endsection
