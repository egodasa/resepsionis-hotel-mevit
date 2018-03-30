<template>
<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<template v-for="(x,index,key) in listMenu">
				<template v-if="x.child">
					<li class="treeview">
						<a href="#">
							<i :class="x.icon"></i> <span>{{x.text}}</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<template v-for="(y,index,key) in x.child">
								<li><a :href="y.url"><i :class="y.icon"></i> <span> {{y.text}}</span></a></li>
							</template>
						</ul>
					</li>
				</template>
				<template v-else>
					<li><a :href="x.url"><i :class="x.icon"></i> <span> {{x.text}}</span></a></li>
				</template>
			</template>
		</ul>
	</section>
</aside>
</template>
<script>
export default {
	data (){
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
