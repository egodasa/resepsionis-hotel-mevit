@extends('layout')
@section('title','Ekstend layout blade')
@section('content')
	<div id="app"></div>
	<div id="app_2">
		<header-section></header-section>
		<sidebar-section :list-menu="menu"></sidebar-section>
		<content-section>
			<template slot="contentHeader">
				<h1>Contoh Halaman Vue 2 </h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Tables</a></li>
						<li class="active">Data tables</li>
					</ol>
			</template>
			<template slot="content">
				<div class="box-header">
					<h4>Halaman ini menggunakan file <b>halamanvue2.blade.php</b></h4>
				</div>
				<div class="box-body">
					Halaman ini dibuat dengan cara yang sama pada Halaman Vue 0, namun
					pada halaman ini, terdapat instance vue baru. Dan dengan instance vue baru ini, kita dapat melakukan passing
					 data ke komponen, seperti pada komponen sidebar. Kita dapat menambahkan atau menggunakan menu yang berbeda pada halaman ini atau yang lain
					  dengan cara membuat instance vue baru dan passing data menu ke komponen ke sidebar.
				</div>
			</template>
		</content-section>
		<footer-section></footer-section>
	</div>
	<script src="{{asset('js/app.js')}}"></script>
	<script>
	let app_2 = new Vue({
		el : "#app_2",
		data (){
			return {
				menu : [
					{
						url : '/',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 0'
					},
					{
						url : '/vue',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 1'
					},
					{
						url : '/vue2',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 2'
					}
				]
			}
		}
	})
	</script>
	<script src="{{asset('js/app_adminlte.js')}}"></script>
@endsection
