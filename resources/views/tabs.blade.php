@extends('layout')
@section('title','Contoh Form')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Contoh Tabs</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h3>Halaman ini dibuat menggunakan file <b><u>resource/views/tabs.blade.php</u></b></h3>
			</div>
			<div class="box-body">
				<tabs>
				  <tab name="t1" title="Tab 1" active=true>
				    Hello World
				  </tab>
				  <tab name="t2" title="Tab 2">
				    Hello World 2
				  </tab>
				  <tab name="t3" title="Tab 3">
				  Hello World 3
				  </tab>
				</tabs>
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
	</div>
@endsection

