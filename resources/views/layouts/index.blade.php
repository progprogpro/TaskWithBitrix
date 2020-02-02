<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucfirst(env('APP_NAME'))}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('style')
</head>
    <body>
        <div id="app">
            <header>
                @include('layouts.header')
            </header>
            <main class="mt-5 mb-5">
                @include('layouts.display_messages')
                @yield('content')
            </main>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
