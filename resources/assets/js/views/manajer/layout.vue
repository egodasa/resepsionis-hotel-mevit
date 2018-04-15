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
						url : '/daftar-transaksi',
						icon : 'fa fa-home',
						text : 'Beranda'
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
