<div class="container">
    <!-- BEGIN: Login Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 p-2">
        <div class="col-1 p-2">
           
          @foreach($data as $value)
            <span class="font-bold uppercase text-lg">{{__('personal information')}}:</span>
            <div class="w-full">
                <div class="text-xl gap-2 items-center w-full ">
                    <!-- <span class="">{{$value->Name}}</span>
                    <span class="">{{$value->LastName}}</span> -->
                </div>
            </div>

                
        </div>
        <div class="col-2  bg-gray-300 md:border-l-4 md:border-primary p-2">
            <span class="-intro-x  font-bold uppercase text-lg ">{{__('CONTACT INFORMATION')}}:</span>
                <div class="w-full">
                    <div class="text-xl gap-2 items-center w-full ">
                        <span class=""></span>
                    </div>
                </div>
        </div>

        @endforeach
    </div>
</div>