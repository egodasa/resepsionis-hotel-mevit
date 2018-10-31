<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/Ionicons/css/ionicons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/skins/_all-skins.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    </head>
    <body class="skin-blue sidebar-mini">
		@yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app_adminlte.js') }}"></script>
    </body>
</html>
