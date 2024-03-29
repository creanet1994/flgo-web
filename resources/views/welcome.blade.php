<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>

    <body>
        
        <div id="app">
            <index></index>
        </div>

      <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>

</html>