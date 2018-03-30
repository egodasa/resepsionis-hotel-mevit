@extends('layout')
@section('title','Tutorial')
@section('content')
	<div id="app">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Tutorial Pembuatan Tabel</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h4>Halaman ini dibuat menggunakan file <b><u>resource/views/tabel.blade.php</u></b></h4>
			</div>
			<div class="box-body">
			<h4>Cara Membuat tabel</h4>
			<ol>
				<li>Tambahkan komponen &lt;vuetable/&gt;</li>
				<li>Tambahkan prop dari komponen tersebut ke variabel dataMix (javascript)</li>
			</ol>
			<h2>Daftar Dosen <small><button class="btn btn-sm btn-primary">Tambah Data</button></small></h2>
			<div class="dataTables_wrapper form-inline dt-bootstrap">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div class="dataTables_paginate paging_simple_numbers pull-left" id="example1_paginate">
						<vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage" :css="pagination">
						</vuetable-pagination>
					</div>
				</div>
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
					<button data-toggle="tooltip_hapus" title="Hapus Data" @click="deleteData(props.rowData.nidn)" type="button" class="btn btn-default btn-xs">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
					<button data-toggle="tooltip_edit" title="Ubah Data" @click="getDetailData(props.rowData.nidn)" type="button" class="btn btn-default btn-xs">
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
			tablePk : 'nidn',
			url_get : "api/dosen",
			perPage : 10,
			search : null,
			defaultSort : [{field:"nm_dosen",direction:"asc"}],
			columns : [
				{name: "__sequence", title:"No"},
				{name: "nm_dosen", title:"Nama Dosen", sortField : "nm_dosen"},
				{name: "nidn", title:"NIDN", sortField : "nidn"},
				{name: "__slot:aksi", title:"Aksi"}
			],
			table : {
				tableClass : 'table table-bordered table-striped dataTable',
				ascendingIcon : 'glyphicon glyphicon-chevron-up',
				descendingIcon : 'glyphicon glyphicon-chevron-down',
				handleIcon : 'sorting'
			},
			pagination : {
				wrapperClass : "pagination pagination-sm no-margin pull-right",
				activeClass : "btn-primary",
				loadingClass:   "overlay",
				disabledClass : "disabled",
				pageClass : "btn btn-border",
				linkClass : "btn btn-border",
				infoClass : "pull-left",
				icons : {
					'first': "glyphicon glyphicon-fast-backward",
				    'prev':"glyphicon glyphicon-backward",
				    'next':"glyphicon glyphicon-forward",
				    'last':"glyphicon glyphicon-fast-forward"
				}
			}
		}
	},
	watch: {
		'perPage' (val, oldVal) {
			this.$nextTick(function() {
				this.refreshTable()
			})
		}
	},
	methods : {
		onChangePage(page) {
			this.$refs.vuetable.changePage(page)
		},
		onPaginationData(paginationData) {
			this.$refs.pagination.setPaginationData(paginationData)
			this.$refs.paginationInfo.setPaginationData(paginationData)
		},
		onSearch(x) {
			this.appendParams.search = x
			this.$refs.vuetable.refresh()
		},
		onResetSearch(x) {
			this.appendParams.search = undefined
			this.search = ''
			this.$refs.vuetable.refresh()
		}
	}
}
</script>
@endsection
