<div>
    <h1 class="p-2 rounded-lg bg-primary text-white">{{__('Shopping')}}</h1>   
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
         @forelse ($data as $dt)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$dt->Name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
              </tr>
        @empty
           
        @endforelse
    </tbody>
</table>
      
      

       
</div>

