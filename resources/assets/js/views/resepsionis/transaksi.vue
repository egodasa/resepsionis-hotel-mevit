<template>
<content-section>
	<template slot="content">
		<div class="box-header with-border">
			<div class="pull-left">
				<h3>Transaksi</h3>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-xs-2">
					<label>Kewarganegaraan</label> 
					<select class="form-control" v-model="kewarganegaraan">
						<option v-for="list in listKewarganegaraan" :value="list">{{list}}</option>
					</select>
				</div>
				<div class="col-xs-10">
					<label for="formInputno_identitas">No Identitas</label>
					<input id="formInputno_identitas" type="text" class="form-control" v-model="no_identitas">
					<p class="help-block text-red"></p>
				</div>
				
				<div class="col-xs-6">
					<label>Nama Pemesan</label> 
					<input type="text" class="form-control" v-model="nm_pemesan">
					<p class="help-block text-red"></p>
				</div>
				<div class="col-xs-6">
					<label>Kontak [NOHP/Email/Fax]</label>
					<input type="text" class="form-control" v-model="kontak">
					<p class="help-block text-red"></p>
				</div>
				
				<div class="col-xs-6">
					<datepicker label="Tanggal Check In" v-model="tgl_checkin" placeholder="Pilih Tanggal" :bootstrap-styling.Boolean="true"></datepicker>
				</div>
				<div class="col-xs-6">
					<datepicker label="Tanggal Check Out" v-model="tgl_checkout" placeholder="Pilih Tanggal" :bootstrap-styling.Boolean="true"></datepicker>
				</div>
				
				<div class="col-xs-4">
					<label class="col-md-4 control-label">Tipe Kamar</label> 
					<div class="col-md-8">
						<select class="form-control" v-model="tipe_kamar" @change="cariNoKamar(tipe_kamar.id_tkamar)">
							<option v-for="list in listTipeKamar" :key="list.id_tkamar" :value="list">{{list.nm_tkamar}}</option>
						</select>
					</div>
				</div>
				<div class="col-xs-4">
					<label class="col-md-4 control-label">Nomor Kamar</label>
					<div class="col-md-8"> 
						<input type="text" class="form-control" v-model="no_kamar" readonly>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="input-group">
						<input id="formInputtotal_orang" type="number" class="form-control" v-model="total_orang" readonly>
						<span class="input-group-addon">Orang</span>
						<span class="input-group-addon btn-success" @click="tambahOrang()" :disabled="no_kamar == 'null' || no_kamar.length > 5">+</span>
						<span class="input-group-addon btn-danger" @click="kurangOrang()" :disabled="no_kamar == 'null' || no_kamar.length > 5">-</span>
					</div>
					<p class="help-block text-red"></p>
				</div>
				
				<div class="col-xs-12">
					<label>Total Bayar</label>
						<input id="formInputtotal_bayar_kamar" type="number" class="form-control" v-model="total_bayar_kamar">
						<p class="help-block text-red"></p>
				</div>
			</div>
			<div class="pull-right">
				<button class="btn btn-primary" @click="tambahKamar()">Tambah</button>
				<button class="btn btn-danger" @click="resetKamar()">Reset</button>
			</div>
			<h3>Kamar yang dipesan</h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tipe Kamar</th>
						<th>No Kamar</th>
						<th>Orang</th>
						<th>Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="listKamarDipesan.length == 0">
						<tr>
							<td colspan=5>Tidak Ada kamar</td>
						</tr>
					</template>
					<template v-else>
						<tr v-for="(x,index,key) in listKamarDipesan">
							<td>{{index+1}}</td>
							<td>{{x.nm_tkamar}}</td>
							<td>{{x.no_kamar}}</td>
							<td>{{x.orang}}</td>
							<td>{{x.hrg_tkamar}}</td>
							<td><button type="button" class="btn btn-sm btn-danger" @click="hapusKamar(index)">Hapus</button></td>
						</tr>
					</template>
				</tbody>
			</table>
			<div class="form-group">
				<label>Total Yang Harus Dibayarkan</label>
				<input type="number" v-model="total_bayar" class="form-control" readonly>
			</div>
			<div class="pull-right">
				<button class="btn btn-primary" @click="simpanTransaksi()">Simpan Transaksi</button>
				<button class="btn btn-danger" @click="resetForm()">Reset</button>
				<button class="btn btn-success" @click="toggleForm()">Batal</button>
			</div>
		</div>
	</template>
</content-section>
</template>

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import { dataMix } from './dataMix.js'
import Datepicker from 'vuejs-datepicker';
import format from 'date-fns/format'

export default{
	name : 'transaksi',
	components : {
		'vuetable' : Vuetable,
		'vuetable-pagination' : VuetablePagination,
		'vuetable-pagination-info' : VuetablePaginationInfo,
		Datepicker
	},
	mixins : [dataMix],
	data(){
		return {
			id_pesan : new Date().getTime().toString(),
			tgl_checkin : new Date(),
			tgl_checkout : new Date(),
			no_identitas : null,
			total_orang : 0,
			kewarganegaraan : null,
			kontak : null,
			nm_pemesan: null,
			tipe_kamar : {},
			total_bayar_kamar : 0,
			listKewarganegaraan : ["WNI","WNA"],
			listTipeKamar : [],
			batas_kamar : 0,
			extra_bed :150000,
			listKamarDipesan : [],
			total_bayar : 0,
			selected_kamar: {},
			no_kamar: "Silahkan pilih tipe kamar..."
		}
	},
	created (){
		axios.get('/api/tipe-kamar')
			.then(res=>{
				this.listTipeKamar = res.data.data
			})
			.catch(err=>{
				this.$notify.error('Tidak dapat mengambil daftar tipe kamar. Silahkan refresh halaman!')
			})
	},
	methods : {
		cariNoKamar (no){
			let url = '/api/pilih-kamar/'+no
			let a = this.listKamarDipesan.length
			if(a != 0){
				let selected_kamar = []
				for(let x = 0; x < a; x++){
					selected_kamar.push(this.listKamarDipesan[x].id_kamar)
				}
				url += "?selected_kamar="+selected_kamar.toString()
			}
			axios.get(url)
				.then(res=>{
					let hasil = res.data.data
					if(hasil == null){
						this.no_kamar = "Kamar tidak tersedia..."
						this.resetPilihTipeKamar()
					}else{
						this.selected_kamar = hasil
						this.no_kamar = this.selected_kamar.no_kamar
						this.totalBayarKamar()
					}
				})
				.catch(err=>{
					console.log(err)
					this.$notify.danger('Tidak dapat memilih kamar...')
				})
		},
		totalBayarKamar (){
			this.batas_kamar = this.tipe_kamar.kapasitas
			this.total_orang = this.tipe_kamar.kapasitas
			this.total_bayar_kamar = this.tipe_kamar.hrg_tkamar
		},
		tambahOrang (){
			if(this.total_orang != 0){
				this.total_orang++
				this.total_bayar_kamar += this.extra_bed
			}
		},
		kurangOrang (){
			if(this.total_orang > this.tipe_kamar.kapasitas){
				this.total_orang--
				this.total_bayar_kamar -= this.extra_bed
			}
		},
		tambahKamar (){
			this.listKamarDipesan.push({
				id_tkamar: this.tipe_kamar.id_tkamar,
				nm_tkamar: this.tipe_kamar.nm_tkamar,
				orang: this.total_orang,
				hrg_tkamar: this.total_bayar_kamar * Math.ceil((this.tgl_checkout - this.tgl_checkin)/86400000),
				id_kamar: this.selected_kamar.id_kamar,
				no_kamar: this.selected_kamar.no_kamar
				})
			this.resetPilihTipeKamar()
			this.totalBayar()
		},
		resetKamar() {
			this.listKamarDipesan = []
			this.total_bayar = 0
		},
		hapusKamar(x) {
			this.listKamarDipesan.splice(x,1)
			this.totalBayar()
		},
		totalBayar (){
			this.total_bayar = 0
			let a = this.listKamarDipesan.length
			for(let x = 0; x < a; x++){
				this.total_bayar += this.listKamarDipesan[x].hrg_tkamar
			}
		},
		simpanTransaksi (){
			let trx = {
				id_pesan: this.id_pesan,
				tgl_checkin: format(this.tgl_checkin,'YYYY-MM-DD HH:mm:ss'),
				tgl_checkout: format(this.tgl_checkout,'YYYY-MM-DD HH:mm:ss'),
				no_identitas: this.no_identitas,
				kewarganegaraan: this.kewarganegaraan,
				nm_pemesan: this.nm_pemesan,
				kontak: this.kontak,
				detail : []
			}
			let a = this.listKamarDipesan.length
			for(let x = 0; x < a; x++){
				trx.detail.push({
					id_pesan: this.id_pesan,
					id_kamar: this.listKamarDipesan[x].id_kamar,
					jumlah_orang: this.listKamarDipesan[x].orang,
					total_harga: this.listKamarDipesan[x].hrg_tkamar
				})
			}
			console.log(trx)
			axios.post('/api/transaksi',trx)
				.then(res=>{
					console.log("berhasil")
					this.resetTransaksi()
				})
				.catch(err=>{
					console.log(err)
					this.$notify.error('Tidak dapat menyimpan transaksi')
				})
		},
		resetPilihTipeKamar (){
			this.total_bayar_kamar = 0
			this.total_orang = 0
			this.tipe_kamar = {}
			this.selected_kamar = {}
			this.no_kamar = "Silahkan pilih tipe kamar..."
		},
		resetTransaksi (){
			this.id_pesan = new Date().getTime().toString()
			this.kewarganegaraan = null
			this.no_identitas = null
			this.kontak = null
			this.nm_pemesan = null
			this.tgl_checkin = new Date()
			this.tgl_checkout = new Date()
			this.resetKamar()
			this.resetPilihTipeKamar()
		}
	}
}
</script>
