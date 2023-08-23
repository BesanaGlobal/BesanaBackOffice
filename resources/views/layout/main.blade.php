@extends('../layout/base')

@section('body')
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent overflow-auto">
        @yield('content')
        {{-- @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher') --}}

        <!-- BEGIN: JS Assets-->
        @push('javas')
        @stack('javascript')
            
        @endpush
      
        @vite('resources/js/app.js')
<script src="//unpkg.com/alpinejs" defer></script>

        <!-- END: JS Assets-->


    </body>
@endsection
