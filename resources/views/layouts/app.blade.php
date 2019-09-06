<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Blog - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="{{ asset('libs/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container">
            <div class="main">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
                    <a class="{{ (request()->is('article*')) ? 'active' : '' }}" href="{{route('articles.index')}}">Articles</a>
                    <a class="{{ (\Request::route()->getName() == 'about.index') ? 'active' : '' }}" href="{{route('about.index')}}">About</a>
                </div>
                <div class="main__nav">
                    <nav class="nav">
                        @yield('nav')
                    </nav>
                </div>
            </div>
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
        </div>
    </body>
</html>