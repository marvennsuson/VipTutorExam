<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    @stack('styles')
    @yield('style')
</head>
<body>
    <div id="app">
        @include('layouts.navigation')
        @if (Auth::check() && Auth::user()->role == 1)
        <div class="container mt-4">
            <div class="float-start">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            @if (Route::is('admin.dashboard.index'))
            <div class="float-end">
                <a href="{{  route('admin.product.index')  }}" class="btn btn-info">List Product</a>
            </div>  
            <div class="float-end">
             &nbsp;
             &nbsp;
            </div>    
            <div class="float-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-info">List User</a>
            </div>   
            @elseif (Route::is('admin.product.index'))
            <div class="float-end">
                <a href="{{  route('admin.dashboard.index')  }}" class="btn btn-info">Back to Dashboard</a>
            </div>  
            <div class="float-end">
                &nbsp;
                &nbsp;
               </div>   
            <div class="float-end">
                
                <a href="{{  route('admin.product.create')  }}" class="btn btn-info">Create Product</a>
            </div>   
           
           
            @endif
          
        </div>
        @endif
    
        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    @yield('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

</body>
</html>
