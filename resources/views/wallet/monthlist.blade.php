@extends('../layout/' . $layout)

@section('subhead')
    <title>Wallets Response </title>
@endsection

@section('subcontent')
<div class="mx-auto rounded-md overflow-hidden bg-gray-300 shadow-lg mt-4">
  @if (session('success'))
          <div class="alert alert-success text-white">
              {{ session('success') }}
          </div>
      @endif
  <div class="-mx-4 sm:-mx-8 overflow-x-auto">
    <div class="inline-block min-w-full px-4 sm:px-8">
      <div class="overflow-hidden border border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                ID
              </th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
               {{__('Username')}}
              </th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                TOTAL
              </th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                {{_('State')}}
              </th>
              <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                {{_('Options')}}
              </th>
              
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($walletMonth as $w )
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
               {{$w->id}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
               {{$w->user->userName}}
                
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
               {{$w->total}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{$w->estado}}
               
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                @if ($w->estado=='eliminado'||$w->estado=='aprobado')
                    <span class="text-black bg-yellow-200 hover:bg-green-800 rounded-md px-4 py-2">{{__('No action')}}</span>
                @else
                    <div class="flex justify-center px-4 py-2">
                      <form action="{{route('btnAprobarWeek')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$w->id}}">
                        <button type="submit"  class="text-white bg-green-700  rounded-md px-4 py-2">
                          {{_('Pay')}}
                        </button>
                      </form>
                      
                      <button class="text-white bg-red-500 hover:bg-red-700 rounded-md px-4 py-2 ml-3">
                        {{__('Cancel')}}
                      </button>
                    </div>
                @endif
                  
              </td>
            </tr>
            @endforeach
            
            <!-- More table rows... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  </div>
  
    
@endsection

@section('script')
    @vite('resources/js/ckeditor-classic.js')
@endsection
