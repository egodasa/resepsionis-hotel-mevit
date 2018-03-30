@extends('layout')
@section('title','Tutorial')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Tutorial Pembuatan Halaman</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h4>Halaman ini dibuat menggunakan file <b><u>resource/views/welcome.blade.php</u></b></h4>
				 dan didaftarkan dengan nama komponen <b>&lt;contoh-halaman/&gt;, serta diterapkan ke view blade dengan nama <b>halamanvue.blade.php</b></b>
			</div>
			<div class="box-body">
				Kita bisa membuat halaman dengan 2 cara : <?="{{daftar}}"?>
				<ol>
					<li>Membuat halaman dengan komponen vue 99% dan blade 1%<br/>
						<ul>
							<li>Membuat sebuah komponen atau halaman pada <b><u>resource/assets/js/components</u></b>
							 dan memasukannya ke file view laravel sesuai dengan nama komponen yang diinginkan.
							</li>
						</ul>
					</li>
					<li>
					Membuat halaman dengan vue 50% dan blade 50% 
						<ul>
							<li>Membuat sebuah view pada laravel</li>
							<li>Kemudian buat instance baru vue, dan tambahkan komponent vue (resource/assets/js/components/master)
							<br/>
							Komponen yang harus ada di view laravel adalah :
								<ul>
									<li> &lt;header-header/&gt; </li>
									<li> &lt;sidebar-header/&gt; </li>
									<li> &lt;content-header/&gt; </li>
									<li> &lt;footer-header/&gt; </li>
								</ul>
							Untuk contoh, bisa dilihat pada halaman ini, dengan cara mengklik tombol <b>CTRL + U</b> pada browser.
							</li>
						</ul>
					</li>
				</ol>
			<alert type="info">
			<h4><i class="icon fa fa-info"></i> Info</h4>
			<u>Silahkan kombinasikan dengan template engine yang ada, agar lebih efisien. Terutama dalam membuat halaman dengan struktur
			 dinamis sesuai hak akses pengguna.</u>
			</alert>
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
	</div>
@endsection

@section('vuedata')
<script>
dataMix = {
	data(){
		return {
			daftar : "gundul"
		}
	}
}
</script>
@endsection
