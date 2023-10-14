@extends('../layout/' . $layout)

@section('subhead')
    <title>Wallets Response</title>
@endsection

@section('subcontent')
  <div class="mx-auto rounded-md overflow-hidden bg-gray-300 shadow-lg mt-4">
    @if (session('success'))
      <div class="alert alert-success text-white">{{ session('success') }}</div>
    @endif

  <livewire:wallet-week-list-table />

@endsection

@section('script')
    @vite('resources/js/ckeditor-classic.js')
@endsection
