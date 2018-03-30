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
			Ini adalah beranda admin...
		</div>
	</template>
</content-section>
</template>

<script>

import content from '../../components/spa/content.vue'
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
