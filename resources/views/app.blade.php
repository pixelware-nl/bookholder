<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <title>Bookholder by Pixelware</title>

        @inertiaHead
        @routes

        @vite('resources/js/app.js')
        @vite('resources/css/app.css')
    </head>
    <body>
        @inertia
    </body>
</html>
