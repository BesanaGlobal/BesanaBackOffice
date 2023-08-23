<div>
    <h1 class="p-2 rounded-lg bg-primary text-white">{{__('My shopping')}}</h1>
    <div class="mt-4">
        <h1 class="text-xl font-bold text-primary">{{__('Select dates')}}</h1>
        @if ($mensaje)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡{{__('Warning')}}!</strong>
            <span class="block sm:inline">{{$mensaje}}</span>
          </div>
        @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="nombre">{{__('Start')}}</label>
          <input class="form-input rounded-md shadow-sm w-full px-3 py-2 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" type="date" id="datestart" wire:model="datestart" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="email">{{__('End')}}</label>
          <input class="form-input rounded-md shadow-sm w-full px-3 py-2 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" type="date" id="dateend" wire:model="dateend"  />
        </div>
        <div>
          <button wire:click="query" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">{{__('Query')}}</button>
        </div>
      </div>
      
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Product')}}</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Price')}}</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Points')}}</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Date')}}</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
         @forelse ($data as $d)
        
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$d->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$. {{$d->price}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$d->puntos}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$d->datetimeb}}</td>

              </tr>
        @empty
           
        @endforelse
    </tbody>
</table>
      
      

       
</div>
