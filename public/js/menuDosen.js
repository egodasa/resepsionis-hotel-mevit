let dataMenu = {
	data () {
		return {
			menu : [
					{
						url : '/dosen/'+this.$lcs.getLcs('info_login').username,
						icon : 'fa fa-dashboard',
						text : 'Beranda'
					},
					{
						url : '/dosen/'+this.$lcs.getLcs('info_login').username+'/kuliah',
						icon : 'fa fa-dashboard',
						text : 'Data Kuliah'
					},
					{
						url : '/dosen/'+this.$lcs.getLcs('info_login').username+'/ujian',
						icon : 'fa fa-dashboard',
						text : 'Data Ujian'
					}
				]
		}
	}
}
