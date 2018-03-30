@extends('dosen.layout')
@section('title','Beranda')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<section>
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<div class="small-box bg-green">
		            <div class="inner">
						<h3><?=$statistik->total_mahasiswa?></h3>
						<p>Mahasiswa</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-person-stalker"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="small-box bg-yellow">
		            <div class="inner">
						<h3><?=$statistik->total_dosen?></h3>
						<p>Dosen</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-person"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="small-box bg-aqua">
		            <div class="inner">
						<h3><?=$statistik->total_ujian?></h3>
						<p>Ujian</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-bag"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="small-box bg-aqua">
		            <div class="inner">
						<h3><?=$statistik->total_kuliah?></h3>
						<p>Kuliah</p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-bag"></i>
		            </div>
		            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
		</div>
	</section>
		</template>
		<template slot="content">
			<div class="box-header with-border">
				<h3>Beranda</h3>
			</div>
			<div class="box-body">
				<?php
				$data = [
					"fields"=> [
						[
							"name"=>"nm_dosen",
							"title"=>"Dosen"
						],
						[
							"name"=>"nm_matkul",
							"title"=>"Matkul"
						],
						[
							"name"=>"nm_jujian",
							"title"=>"Jenis Ujian"
						],
						[
							"name"=>"avg",
							"title"=>"Rata-rata"
						]
					],
					"data"=> $nilai
				];
				?>
				@component('components.list',['data'=>$data])
					@slot('header')
						<h3>Nilai rata-rata 10 tertinggi</h3>
					@endslot
					@slot('footer')
						-----
					@endslot
				@endcomponent
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
	</div>
@endsection

