<template>
<div class="wrapper">
	<header-section></header-section>
	<sidebar-section :listMenu="listMenu"></sidebar-section>
	<content-section>
		<template slot="contentHeader">
			<h1>Judul H1 </h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data tables</li>
				</ol>
		</template>
		<template slot="content">
			<div class="box-header">
				<h4>Judul H4</h4>
			</div>
			<div class="box-body">
				ksmdlmlkaskmdkmkmdmsamdmsadmklmaskdklfnnsfnsdfbjsdjfkkasjekfesnfendndnendnejdnjsednjeskndsandsnk
				desdnesdenjsenjendjjsek
			</div>
		</template>
	</content-section>
	<footer-section></footer-section>
</div>
</template>

<script>
import content from ',/master/content.vue'
import footer from ',/master/footer.vue'
export default{
	components : {
		"content-section" : content,
		"footer-section" : footer,
		"sidebar-section" : sidebar,
		"header-section" : header
	},
	data(){
		return {
			listMenu : [
				{
					url : 'contoh1',
					icon : 'fa fa-dashboard',
					text : 'contoh 1'
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
