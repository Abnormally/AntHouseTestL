<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#000">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Заголовок страницы')</title>
    <meta name="description" content="@yield('description', 'Описание страницы')">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    @yield('stylesheets')
</head>

<body>
    @include('layouts.partials.header')

    <main role="main" id="app" style="margin-top: 55px">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    {{-- Scripts --}}
    <div style="display: none">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </div>
</body>

</html>
