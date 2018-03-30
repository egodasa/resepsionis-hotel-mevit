let dataMenu = {
	data() {
		return {
			menu: [{
					url: '/',
					icon: 'fa fa-dashboard',
					text: 'Halaman 1'
				},
				{
					url: '/vue',
					icon: 'fa fa-dashboard',
					text: 'Halaman 2'
				},
				{
					url: '/vue2',
					icon: 'fa fa-dashboard',
					text: 'Halaman 3'
				},
				{
					url: '/tabel',
					icon: 'fa fa-dashboard',
					text: 'Contoh Komponen',
					child: [
						{
							url: '/form',
							icon: 'fa fa-dashboard',
							text: 'Form Modal'
						},
						{
							url: '/tabel',
							icon: 'fa fa-dashboard',
							text: 'Tabel'
						},
						{
							url: '/tabs',
							icon: 'fa fa-dashboard',
							text: 'Tabs'
						}
					]
				}
			]
		}
	}
}
