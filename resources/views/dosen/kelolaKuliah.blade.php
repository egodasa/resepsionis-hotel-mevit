@extends('dosen.layout')
@section('title','Kelola Kuliah')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
				
		</template>
		<template slot="content">
			<div class="box-header with-border">
				<div class="pull-left">
					<h3>Daftar Kuliah</h3>
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
			tablePk : 'id_kuliah',
			url_get : "/api/dosen/<?=$_NIDN;?>/kuliah",
			defaultSort : [{field:"nm_matkul",direction:"asc"}],
			columns : [
				{name: "__sequence", title:"No"},
				{name: "id_kuliah", title:"ID", sortField : "id_kuliah",visible:false},
				{name: "nm_matkul", title:"Nama Matkul", sortField : "nm_matkul"},
				{name: "kelas", title:"Kelas", sortField : "kelas",callback: function(val){ 
					let data = JSON.parse(val)
					let kelas = []
					for(let x = 0; x < data.length; x++){
						kelas.push(data[x].nm_kelas)
					}
					return kelas.toString()
				}
				},
				{name: "nm_status_kuliah", title:"Status", sortField : "nm_status_kuliah"},
				{name: "__slot:aksi", title:"Aksi"}
			],
			form : {
				model : {
					nidn : this.$lcs.getLcs('info_login').username,
					kd_matkul : null,
					tahun_akademik : null,
					status_kuliah : 0
				},
				error : {
					kd_matkul : null,
					tahun_akademik : null,
				},
				fields : [
					{
						name:'kd_matkul',
						label:'Mata Kuliah',
						type : 'select',
						inputType : 'text',
						optionLabel : 'nm_matkul',
						option : []
					},
					{
						name:'tahun_akademik',
						label:'Tahun Akademik',
						type : 'input',
						inputType : 'number'
					}
				]
			}
		}
	},
	created (){
		axios.get('/api/matkul')
		.then(res=>{
			this.form.fields[0].option = res.data.data
		})
		.catch(err=>{
			this.$notify.danger('Tidak dapat mengambil daftar mata kuliah!')
		})
	},
	methods : {
		kelasToString (val){
			return val+"asasd";
		}
	}
}
</script>
@endsection
