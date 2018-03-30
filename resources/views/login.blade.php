<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="/adminlte/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="/adminlte/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="/adminlte/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="/adminlte/skins/_all-skins.min.css">
		<link rel="stylesheet" href="/adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css">
    </head>
   <body class="hold-transition login-page">
	<div id="app">
	<login/>
	</div>
<script src="/js/app.js"></script>
<script src="/js/app_adminlte.js"></script>
</body>
</html>
