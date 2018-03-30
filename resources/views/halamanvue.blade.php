@extends('layout')
@section('title','Ekstend layout blade')
@section('content')
	<div id="app">
		<contoh-halaman></contoh-halaman>
	</div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/app_adminlte.js')}}"></script>
@endsection
