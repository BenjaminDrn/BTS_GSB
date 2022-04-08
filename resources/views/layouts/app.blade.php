<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laboratoire Galaxy Swiss Bourdin</title>
    @yield('style')
    <link rel="shortcut icon" href="{{ asset('img/logoGSB.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/boxicons/css/boxicons.min.css') }}">

</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @yield('script')
    <script src="{{ asset('lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
