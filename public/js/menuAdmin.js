let dataMenu = {
	data () {
		return {
			menu : [
					{
						url : '/admin',
						icon : 'fa fa-dashboard',
						text : 'Beranda'
					},
					{
						url : '/admin/dosen',
						icon : 'fa fa-dashboard',
						text : 'Data Dosen'
					},
					{
						url : '/admin/mahasiswa',
						icon : 'fa fa-dashboard',
						text : 'Data Mahasiswa'
					},
					{
						url : '/admin/jenis-ujian',
						icon : 'fa fa-dashboard',
						text : 'Data Jenis Ujian'
					},
					{
						url : '/admin/jenis-soal',
						icon : 'fa fa-dashboard',
						text : 'Data Jenis Soal'
					},
					{
						url : '/admin/kelas',
						icon : 'fa fa-dashboard',
						text : 'Data Kelas'
					},
					{
						url : '/admin/matkul',
						icon : 'fa fa-dashboard',
						text : 'Data Matkul'
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
