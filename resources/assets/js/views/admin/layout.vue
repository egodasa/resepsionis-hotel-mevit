<template>
<div class="wrapper">
	<header-section :username="username"></header-section>
	<sidebar-section :list-menu="menu"></sidebar-section>
	<router-view></router-view>
	<footer-section></footer-section>
</div>
</template>

<script>
import footer from '../../components/footer.vue'
import sidebar from '../../components/sidebar.vue'
import header from '../../components/header.vue'
export default{
	data(){
		return {
			menu : [
					{
						url : '/',
						icon : 'fa fa-home',
						text : 'Beranda'
					},
					{
						url : '/admin/daftar-kamar',
						icon : 'fa fa-hotel',
						text : 'Daftar Kamar'
					},
					{
						url : '/admin/tipe-kamar',
						icon : 'fa fa-server',
						text : 'Daftar Tipe Kamar'
					},
					{
						url : '/admin/user',
						icon : 'fa fa-user',
						text : 'Data User'
					}
				],
			username: null
		}
	},
	created (){
		if(this.$lcs.getLcs('info_login')){
			this.username = this.$lcs.getLcs('info_login').username
		}
	}
}
</script>
