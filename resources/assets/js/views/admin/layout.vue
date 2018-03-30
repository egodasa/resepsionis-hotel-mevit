<template>
<div class="wrapper">
	<header-section></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<router-view></router-view>
	<footer-section></footer-section>
</div>
</template>

<script>
import footer from '../../components/master/footer.vue'
import sidebar from '../../components/master/sidebar.vue'
import header from '../../components/master/header.vue'
export default{
	data(){
		return {
			menu : [
					{
						url : '/',
						icon : 'fa fa-dashboard',
						text : 'Beranda'
					},
					{
						url : '/admin/daftar-kamar',
						icon : 'fa fa-dashboard',
						text : 'Daftar Kamar'
					},
					{
						url : '/admin/tipe-kamar',
						icon : 'fa fa-dashboard',
						text : 'Daftar Tipe Kamar'
					},
					{
						url : '/admin/daftar-pemesan',
						icon : 'fa fa-dashboard',
						text : 'Data Pemesan'
					},
					{
						url : '/admin/user',
						icon : 'fa fa-dashboard',
						text : 'Data User'
					}
				]
		}
	}
}
</script>
