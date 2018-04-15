<template>
<content-section>
	<template slot="content">
		<div class="box-header with-border">
			<div class="pull-left">
				<h3>Daftar Transaksi</h3>
			</div>
			<div class="pull-right">
				<button class="btn btn-primary" @click="modalCetak = !modalCetak">Cetak Laporan</button>
				<modal :show="modalCetak" title="Cetak Laporan">
					<template slot="modalBody">
						<form action="/pdf" method="GET">
							<datepicker label="Pilih waktu awal" :bootstrap-styling.Boolean="true" name="start" format="yyyy-MM-dd" placeholder="Dari..."></datepicker>
							<datepicker label="Pilih waktu akhir" :bootstrap-styling.Boolean="true" name="finish" format="yyyy-MM-dd" placeholder="Ke..."></datepicker>
							<button type="submit" class="btn btn-primary">Cetak</button>
							<button type="button" class="btn btn-danger" @click="modalCetak = !modalCetak">Tutup</button>
						</form>
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
			pagination-path="" 
			:api-url="url_get" 
			:css="table" 
			@vuetable:pagination-data="onPaginationData"
			:per-page="perPage">
			<template slot="aksi" slot-scope="props">
				<button @click="detailTransaksi(props.rowData)" type="button" class="btn btn-primary btn-xs">
					Detail
				</button>
			</template>
		</vuetable>
		<modal :show="modalStatus" :title="'Detail Transaksi #' + selected_transaksi.id_pesan">
			<template slot="modalBody">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Nama Pemesan</label>
							<p>{{selected_transaksi.nm_pemesan}}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nomor Identitas</label>
							<p>{{selected_transaksi.no_identitas}}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Kewarganegaraan</label>
							<p>{{selected_transaksi.kewarganegaraan}}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Kontak</label>
							<p>{{selected_transaksi.kontak}}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Tanggal Checkin</label>
							<p>{{selected_transaksi.tgl_checkin}}</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Tanggal Checkout</label>
							<p>{{selected_transaksi.tgl_checkout}}</p>
						</div>
					</div>
				</div>
				<h4>Daftar Kamar yang dipesan</h4>
				<hr>
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tipe Kamar</th>
						<th>No Kamar</th>
						<th>Orang</th>
						<th>Harga</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(x,index,key) in selected_transaksi.detail">
						<td>{{index+1}}</td>
						<td>{{x.nm_tkamar}}</td>
						<td>{{x.no_kamar}}</td>
						<td>{{x.jumlah_orang}}</td>
						<td>{{x.hrg_tkamar}}</td>
					</tr>
				</tbody>
			</table>
			</template>
			<template slot="modalFooter">
				<div class="pull-right">
					<button class="btn btn-danger" @click="toggleModal()">Tutup</button>
				</div>
			</template>
		</modal>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
					<vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
				</div>
			</div>
		</div>
		</div>
		</div>
	</template>
</content-section>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import format from 'date-fns/format'
import { dataMix } from './dataMix.js'
import lokalisasi from 'date-fns/locale/id'

export default{
	name : 'daftarTransaksi',
	components : {
		'vuetable' : Vuetable,
		'vuetable-pagination' : VuetablePagination,
		'vuetable-pagination-info' : VuetablePaginationInfo,
		Datepicker
	},
	mixins : [dataMix],
	data(){
		return {
			tablePk : 'id_pesan',
			url_get : "/api/transaksi",
			defaultSort : [{field:"id_pesan",direction:"desc"}],
			columns : [
				{name: "__sequence", title:"No"},
				{name: "id_pesan", title:"ID Transaksi", sortField : "id_pesan",visible:false},
				{name: "nm_pemesan", title:"Nama Pemesan", sortField : "nm_pemesan"},
				{name: "kewarganegaraan", title:"Kewarganegaraan", sortField : "kewarganegaraan"},
				{name: "tgl_checkin", title:"Waktu Check In", sortField : "tgl_checkin",callback : function(val){
					return format(val, 'dddd, d MMMM YYYY h:m:s', {locale: lokalisasi})
				}},
				{name: "tgl_checkout", title:"Waktu Check Out", sortField : "tgl_checkout",callback : function(val){
					return format(val, 'dddd, d MMMM YYYY h:m:s', {locale: lokalisasi})
				}},
				{name: "total_harga", title:"Total Bayar", sortField : "total_harga"},
				{name: "__slot:aksi", title:"Aksi"}
			],
			selected_transaksi : {},
			modalCetak: false
		}
	},
	methods : {
		detailTransaksi (detail){
			this.selected_transaksi = detail
			axios.get('/api/transaksi/detail/'+detail.id_pesan)
				.then(res=>{
					this.toggleModal()
					this.selected_transaksi.detail = res.data.data
				})
				.catch(err=>{
					console.log(err)
					this.$notify.error('Tidak dapat mengambil detail transaksi')
				})
		},
		toggleModal (){
			this.modalStatus = !this.modalStatus
		}
	}
}
</script>
