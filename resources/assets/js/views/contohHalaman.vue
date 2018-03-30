<template>
<div class="wrapper">
	<header-section></header-section>
	<sidebar-section :listMenu="menu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Contoh Halaman 2</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h4>Halaman ini dibuat menggunakan file views laravel <b>halamanvue.blade.php dan komponen vue pada views/contohHalaman.vue</b></h4>
			</div>
			<div class="box-body">
				Halaman ini dibuat dengan cara :
				<ul>
					<li>Membuat sebuah komponen atau halaman pada <b><u>resource/assets/js/views/contohHalaman.vue</u></b>
					 dan memasukannya ke file view laravel sesuai dengan nama komponen yang diinginkan.
					</li>
				</ul>
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
</div>
</template>

<script>
import content from '../components/master/content.vue'
import footer from '../components/master/footer.vue'
import sidebar from '../components/master/sidebar.vue'
import header from '../components/master/header.vue'
export default{
	components : {
		"content-section" : content,
		"footer-section" : footer,
		"sidebar-section" : sidebar,
		"header-section" : header
	},
	data(){
		return {
			menu : [
					{
						url : '/',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 0'
					},
					{
						url : '/vue',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 1'
					},
					{
						url : '/vue2',
						icon : 'fa fa-dashboard',
						text : 'Halaman Vue 2'
					},
					{
						icon : 'fa fa-dashboard',
						text : 'contoh 2',
						child : [
							{
								url : 'contoh2.1',
								icon : 'fa fa-dashboard',
								text : 'contoh 2.1'
							},
							{
								url : 'contoh2.2',
								icon : 'fa fa-dashboard',
								text : 'contoh 2.2'
							}
						]
					}
				]
		}
	}
}
</script>
