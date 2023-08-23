@extends('../layout/' . $layout)

@section('subhead')

@endsection

@section('subcontent')
 <div class="card">
   
    
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
      <div class="grid grid-cols-1 justify-center p-4 bg-slate-800">
        <h1 class="text-white font-bold text-center">{{__('User')}}: {{$username[0]->userName}}</h1>
        <h1 class="text-white font-bold text-center">{{__('User')}}: {{$data[0]->idAffiliated}}</h1>

      </div>
      @if (session('success'))
          <div class="alert alert-success text-white">
              {{ session('success') }}
          </div>
      @endif
      <div class="md:flex">
      
        <div class="p-8 bg-slate-300">
          <div class="uppercase tracking-wide text-sm font-semibold">{{__('Week')}}</div>
          <form class="mt-4" method="post" action="{{route('wallet.week')}}">
            @csrf
            <div>
              <input type="hidden" name="idaw" value="{{$data[0]->idAffiliated}}">

              <label class="block text-gray-700 font-bold mb-2" for="username">
                {{__('Start')}}
              </label>
              
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" 
                type="date"  name="start">
                @if ($errors->has('start'))
                    <div class="alert alert-danger">
                        {{ $errors->first('start') }}
                    </div>
                @endif
            </div>
            <div class="mt-2">
              <label class="block text-gray-700 font-bold mb-2" for="username">
                {{__('End')}}
              </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" 
                type="date"  name="end">
                @if ($errors->has('end'))
                    <div class="alert alert-danger">
                        {{ $errors->first('end') }}
                    </div>
                @endif
            </div>
            <div class="mt-4">
              <label class="block text-gray-700 font-bold mb-2" for="total">
                {{__('Amount')}}
              </label>
              <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="total" type="number" step="0.01" name="cantidad">
              @if ($errors->has('cantidad'))
                    <div class="alert alert-danger">
                        {{ $errors->first('cantidad') }}
                    </div>
                @endif
              </div>
            <button class="mt-4 bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
              {{__('Send')}}
            </button>
          </form>
        </div>
        <div class="p-8">
          <div class="uppercase tracking-wide text-sm font-semibold">{{__('Month')}}</div>
          <form class="mt-4" method="post" action="{{route('wallet.month')}}">
            @csrf
            <div>
              <input type="hidden" name="idam" value="{{$data[0]->idAffiliated}}">

              <label class="block text-gray-700 font-bold mb-2" for="username">
                {{__('Start')}}
              </label>
              
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" 
                type="date"  name="startM">
                @if ($errors->has('startM'))
                    <div class="alert alert-danger">
                        {{ $errors->first('startM') }}
                    </div>
                @endif
            </div>
            <div class="mt-2">
              <label class="block text-gray-700 font-bold mb-2" for="username">
                {{__('End')}}
              </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" 
                type="date"  name="endM">
                @if ($errors->has('endM'))
                    <div class="alert alert-danger">
                        {{ $errors->first('endM') }}
                    </div>
                @endif
            </div>
            <div class="mt-4">
              <label class="block text-gray-700 font-bold mb-2" for="total">
                {{__('Amount')}}
              </label>
              <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="total" type="number" name="cantidadM">
              @if ($errors->has('cantidadM'))
                    <div class="alert alert-danger">
                        {{ $errors->first('cantidadM') }}
                    </div>
                @endif
            </div>

           
           
            <button class="mt-4 bg-orange-800 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
              {{__('Send')}}
            </button>
          </form>
        </div>
      </div>
    </div>
    
      
 </div>
@endsection