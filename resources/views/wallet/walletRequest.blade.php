@extends('../layout/' . $layout)

@section('subhead')
    <title>Wallets Response </title>
@endsection

@section('subcontent')
<div class="max-w-md mx-auto rounded-md overflow-hidden bg-green-200 shadow-lg mt-4">
    <div class="px-6 py-4 ">
      <h2 class="text-lg font-bold text-gray-800 mb-2 uppercase">{{__('select wallet')}}</h2>
    </div>
    <div class="px-6 py-4">
      <a href="{{route('weeklist')}}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-full mr-2">{{__('Week')}}</a>
      <a href="{{route('monthlist')}}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-full">{{__('Month')}}</a>
    </div>
  </div>
  
    
@endsection

@section('script')
    @vite('resources/js/ckeditor-classic.js')
@endsection
