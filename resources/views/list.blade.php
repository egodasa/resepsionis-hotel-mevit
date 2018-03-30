@extends('layout1col')
@section('title','Tutorial')
@section('content')
	<div id="app">
		<col-1-header-section :list-menu="menu"></col-1-header-section>
		<col-1-content-section>
			<template slot="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header with-border">
							Halaman Kolom 1
							</div>
							<div class="box-body">
								<p>Halaman kolom 1 terdiri atas komponen &lt;col-1-*&gt;, dimana * adalah header-section,content-section dan footer-section.</p>
								<p>Struktur dan slot sama dengan halaman yang 2 kolom. Hanya nama komponen saja yang berbeda, dengan awalan col-1-*</p>
								<p>Tekan CTRL + U untuk melihat kodingnya</p>
								<p>Pada komponen header, terdapat slot headerRight untuk mengisi konten pada sebelah kanan header</p>
							</div>
							<div class="box-footer">Footer</div>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="box">
							<div class="box-header with-border">
							Judul
							</div>
							<div class="box-body">
								<img src="/img/user2-160x160.jpg" width="300" />
							</div>
							<div class="box-footer">Footer</div>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="box">
							<div class="box-header with-border">
							Judul
							</div>
							<div class="box-body">
								<img src="/img/user2-160x160.jpg" width="300" />
							</div>
							<div class="box-footer">Footer</div>
						</div>
					</div>
					<div class="col-lg-4 col-xs-12">
						<div class="box">
							<div class="box-header with-border">
							Judul
							</div>
							<div class="box-body">
								<img src="/img/user2-160x160.jpg" width="300" />
							</div>
							<div class="box-footer">Footer</div>
						</div>
					</div>
				</div>
			</template>
		</col-1-content-section>
		<col-1-footer-section></col-1-footer-section>
	</div>
@endsection
