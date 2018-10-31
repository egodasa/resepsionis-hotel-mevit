let dataMenu = {
	data () {
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
						url : '/form',
						icon : 'fa fa-dashboard',
						text : 'Contoh Form'
					},
					{
						url : '/tabel',
						icon : 'fa fa-dashboard',
						text : 'Contoh Tabel'
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
