{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container" style="position: relative">
        @if(\Auth::check())
        <span style="position: absolute; right:20px">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                logout
            </a>
        </span>
        @endif
    </div>

    <div id="app" class="mt-3">
        <div>
            <category-list-component></category-list-component>
        </div>
    </div>
</body>

</html>
{{-- @endsection --}}