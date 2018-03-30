@extends('layout')
@section('title','Contoh Form')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Tutorial Form Generator</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h3>Halaman ini dibuat menggunakan file <b><u>resource/views/halamanform.blade.php</u></b></h3>
			</div>
			<div class="box-body">
				Berikut adalah contoh dari form yang dihasilkan (Tekan CTRL + U untuk melihat koding komponen form-generator) :
				<form-generator :model="model" :fields="fields" :error="error"></form-generator>
				Nilai form : <br/>
				NOBP : <?="{{model.nobp}}"?> <br/>
				Nama Mahasiswa : <?="{{model.nm_mahasiswa}}"?>  <br/>
				Kelas (id_kelas) : <?="{{model.id_kelas}}"?> <br/>
				<button class="btn btn-primary" @click="modalStatus = !modalStatus">Klik tombol untuk memunculkan modal form</button>
				<modal :show="modalStatus" title="Tambah Data">
					<template slot="modalBody">
						Berikut adalah contoh dari form yang dihasilkan (Tekan CTRL + U untuk melihat koding komponen form-generator) :
						<form-generator :model="model" :fields="fields" :error="error"></form-generator>
						Nilai form : <br/>
						NOBP : <?="{{model.nobp}}"?> <br/>
						Nama Mahasiswa : <?="{{model.nm_mahasiswa}}"?>  <br/>
						Kelas (id_kelas) : <?="{{model.id_kelas}}"?> <br/>
					</template>
					<template slot="modalFooter">
						<div class="pull-right">
							<button class="btn btn-success">Simpan</button>
						</div>
					</template>
				</modal>
				<h4>Fitur</h4>
				Form generator saat ini support :
				<ul>
					<li>Select</li>
					<li>Input</li>
					<li>Checkbox</li>
					<li>Textarea</li>
					<li>Pesan error dari server side</li>
				</ul>
				<h4>Cara Penggunaan</h4>
				<ol>
				<li>
					Gunakan komponen form generator dengan sintaks &lt;form-generator&gt;&lt;/form-generator&gt; untuk menampilkan form.<br/>
				</li>
				<li>Tambahkan data() untuk form-generator pada variabel dataMix (javascript), data ini nantinya akan dijadikan mixins kedalam instance vue (#app)</li>
				<li>Props dari komponen :
					<ul>
						<li>fields <br/>
						Tipe : Array of object<br/>
						contoh : [{name:nm_mahasiswa, label:"Nama Mahasiswa",type:"input",inputType:"Number",max:"15"}]<br/>
						Kegunaan : Menentukan isi form seperti select,checkbox,input
						</li>
						<li>model<br/>
						Tipe : Object<br/>
						contoh : {nm_mahasiswa:null}<br/>
						Kegunaan : Untuk menampung nilai dari form. Samakan dengan jumlah fields dan samakan dengan properti "name" pada fields
						</li>
						<li>error<br/>
						Tipe : Object<br/>
						contoh : {nm_mahasiswa:""}<br/>
						Kegunaan : Untuk menampung pesan error dari server. Samakan dengan model
						</li>
					</ul>
				</li>
				</ol>
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
	</div>
@endsection

@section('vuedata')
<script>
dataMix = {
	data() {
		return {
			modalStatus : false,
			model : {
				nobp : null,
				nm_mahasiswa : null,
				id_kelas : null
			},
			error : {
				nobp : null,
				nm_mahasiswa : null,
				kelas : null
			},
			fields : [
				{
					name:'nobp',
					label:'NOBP',
					type : 'input',
					inputType : 'text',
					hint : '14 Digit'
				},
				{
					name:'nm_mahasiswa',
					label:'Nama Mahasiswa',
					type : 'input',
					inputType : 'text',
					placeholder : 'Nama Lengkap'
				},
				{
					name: "id_kelas",
					label:'Kelas',
					optionLabel : "nm_kelas",
					type : 'select',
					placeholder : 'Kelas',
					option : [
						{id_kelas : 1, nm_kelas : "SI-1"},
						{id_kelas : 3, nm_kelas : "SI-2"},
						{id_kelas : 2, nm_kelas : "SI-3"}
					]
				}
			]
		}
	}
}
</script>
@endsection
