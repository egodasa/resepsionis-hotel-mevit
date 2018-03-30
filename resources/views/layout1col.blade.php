<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
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
    <body class="hold-transition skin-blue layout-top-nav">
		<div class="wrapper">
		@yield('content')
		</div>
    <script src="/js/app.js"></script>
    <script>
    let dataMix = {}
    </script>
    @yield('vuedata')
	<!--Ganti dataMenu.js dibawah ini sesuai kebutuhan. Karena isi menu diletakkan difile dibawah ini.-->
    <script src="/js/dataMenuContoh.js"></script> 
    <script>
	const app = new Vue({
		el : "#app",
		mixins : [dataMix,dataMenu]
	})
	</script>
    <script src="/js/app_adminlte.js"></script>
    </body>
</html>
