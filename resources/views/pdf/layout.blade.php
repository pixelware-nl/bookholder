<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> {{ $title }} </title>

    <link href="{{ resource_path('css/fonts.css') }}" rel="stylesheet" />
    <link href="{{ resource_path('scss/pdf.scss') }}" rel="stylesheet" />
</head>
<body class="pdf">
    @include('pdf.header')
    <main>
        @yield('content')
    </main>
</body>
</html>
