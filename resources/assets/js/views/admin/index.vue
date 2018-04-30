<template>
<content-section>
	<template slot="contentHeader">
	</template>
	<template slot="content">
		<div class="box-header with-border">
			<div class="pull-left">
				<h3>Beranda</h3>
			</div>
		</div>
		<div class="box-body">
			Sebelum menggunakan aplikasi, harap entrikan data berikut ini :
            <ol>
                <li>Data user, agar orang lain bisa menggunakan aplikasi</li>
                <li>Data tipe kamar, agar data kamar bisa ditambahkan</li>
                <li>Data kamar, agar transaksi bisa dilakukan oleh resepsionis</li>
            </ol>
		</div>
	</template>
</content-section>
</template>

<script>


import { dataMix } from './dataMix.js'
export default{
	name : 'indexAdmin',
	mixins : [dataMix],
	data(){
		return {
			
		}
	}
}
</script>
