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
     <link href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
  <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">

</head>
<body class="bg-dark" style="background: url('https://images.pexels.com/photos/2982449/pexels-photo-2982449.jpeg?cs=srgb&dl=pexels-meliani-idriss-2982449.jpg&fm=jpg'); background-size: cover;">
    <div id="app" class="">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
