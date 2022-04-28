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

    <script>
      window.Translations = @json(getTranslations());
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
{{--    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">--}}
{{--        <ul class="navbar-nav mr-auto">--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="#">Left</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="//codeply.com">Codeply</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Link</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Link</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">Link</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="mx-auto order-0">--}}
{{--        <a class="navbar-brand mx-auto" href="#">Navbar 2</a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--    </div>--}}
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" >
                <a class="text-white">
                   {{ __('global.welcome') }} {{ ucfirst(auth()->user()->name) }}
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @foreach (config('app.locales') as $locale => $locale_name)
                <li class="nav-item" >
                    <a class="nav-link" href="/locale/{{$locale}}">
                        {!!locale_img($locale)!!}
                        {{__("global.$locale")}}
                    </a>
                </li>
            @endforeach
            <li class="nav-item">
                @if(\Auth::check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('global.logout') }}
                </a>
                @endif
            </li>
        </ul>
    </div>
</nav>

{{--<div class="navbar mt-2">--}}
{{--    @if(\Auth::check())--}}
{{--        <span style="position: absolute; right:20px">--}}
{{--                <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                      style="display: none;">--}}
{{--                    @csrf--}}
{{--                </form>--}}
{{--                <a href="#" onclick="event.preventDefault();--}}
{{--                                document.getElementById('logout-form').submit();">--}}
{{--                    Sair--}}
{{--                </a>--}}
{{--            </span>--}}
{{--    @endif--}}
{{--</div>--}}

<div id="app" class="m-2">
    <b-container class="text-center">
        <div>
            <b-tabs content-class="m-0" active>
                <b-tab title="{{ __('global.daily_expenses') }}">
                    <main-index></main-index>
                </b-tab>
                <b-tab :title="__('global.current_month')">
                    <current-month-index></current-month-index>
                </b-tab>
                <b-tab :title="__('global.previous_months')">
                    <previous-months-index></previous-months-index>
                </b-tab>

            </b-tabs>
        </div>
    </b-container>
</div>


</body>

</html>
{{-- @endsection --}}
<style scoped>
    .navbar {
        background-color: #7c7c7c;
        overflow: hidden;
        /*position: fixed;*/
        bottom: 0;
        width: 100%;
        height: 3em;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }
</style>
