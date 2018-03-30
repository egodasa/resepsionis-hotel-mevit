@extends('admin.layout')
@section('title','Kelola Mata Kuliah')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header with-border">
				<div class="pull-left">
					<h3>Daftar Mata Kuliah</h3>
				</div>
				<div class="pull-right">
					<button class="btn btn-primary" @click="modalStatus = !modalStatus">+ Tambah Data Baru</button>
					<modal :show="modalStatus" title="Tambah Data">
						<template slot="modalBody">
							<form-generator :model="form.model" :fields="form.fields" :error="form.error"></form-generator>
						</template>
						<template slot="modalFooter">
							<div class="pull-right">
								<button class="btn btn-primary" @click="saveData()">Simpan</button>
								<button class="btn btn-danger" @click="resetForm()">Reset</button>
								<button class="btn btn-success" @click="toggleForm()">Batal</button>
							</div>
						</template>
					</modal>
				</div>
			</div>
			<div class="box-body">
			<div class="dataTables_wrapper form-inline dt-bootstrap">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div class="dataTables_length pull-left" id="example1_length"><label>Tampilkan
					<select name="example1_length" aria-controls="example1" class="form-control input-sm" v-model="perPage">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select> Data</label>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="dataTables_paginate paging_simple_numbers pull-left" id="example1_paginate">
						<vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage" :css="pagination">
						</vuetable-pagination>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<div class="pull-right">
						<div class="input-group">
							<input v-model="search" type="text" class="form-control" placeholder="Search" @keyup.enter="onSearch(search)">
							<div class="input-group-btn">
								<button @click="onSearch(search)" class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
							<div class="input-group-btn">
								<button @click="onResetSearch" class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<vuetable
				ref="vuetable" 
				track-by="tablePk" 
				:sort-order="defaultSort"
				:reactive-api-url.Boolean="true" 
				:fields="columns" 
				pagination-path="pagination" 
				:api-url="url_get" 
				:css="table" 
				@vuetable:pagination-data="onPaginationData"
				:per-page="perPage">
				<template slot="aksi" scope="props">
					<button data-toggle="tooltip_hapus" title="Hapus Data" @click="deleteData(props.rowData[tablePk])" type="button" class="btn btn-default btn-xs">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
					<button data-toggle="tooltip_edit" title="Ubah Data" @click="getDataDetail(props.rowData[tablePk])" type="button" class="btn btn-default btn-xs">
						<span class="glyphicon glyphicon-pencil"></span>
					</button>
				</template>
			</vuetable>
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
						<vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
					</div>
				</div>
			</div>
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
			tablePk : 'kd_matkul',
			url_get : "/api/matkul",
			defaultSort : [{field:"nm_matkul",direction:"asc"}],
			columns : [
				{name: "__sequence", title:"No"},
				{name: "kd_matkul", title:"Kode Matkul", sortField : "kd_matkul"},
				{name: "nm_matkul", title:"Nama Matkul", sortField : "nm_matkul"},
				{name: "sks", title:"SKS", sortField : "sks"},
				{name: "smt", title:"Semester", sortField : "smt"},
				{name: "__slot:aksi", title:"Aksi"}
			],
			form : {
				model : {
					kd_matkul : null,
					nm_matkul : null,
					sks : null,
					smt : null,
					status_matkul : 1
				},
				error : {
					kd_matkul : null,
					nm_matkul : null,
					sks : null,
					smt : null
				},
				fields : [
					{
						name:'kd_matkul',
						label:'Kode Matkul',
						type : 'input',
						inputType : 'text'
					},
					{
						name:'nm_matkul',
						label:'Nama Matkul',
						type : 'input',
						inputType : 'text',
						hint : 'Maks 100 karakter'
					},
					{
						name:'sks',
						label:'SKS',
						type : 'input',
						inputType : 'number'
					},
					{
						name:'smt',
						label:'Semester',
						type : 'input',
						inputType : 'number'
					}
				]
			}
		}
	}
}
</script>
@endsection
