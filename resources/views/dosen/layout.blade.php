<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/adminlte/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="/adminlte/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="/adminlte/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="/adminlte/skins/_all-skins.min.css">
		<link rel="stylesheet" href="/adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css">
    </head>
    <body class="skin-blue sidebar-mini">
		@yield('content')
    <script src="/js/app.js"></script>
    <script>
    let dataMix = {}
    </script>
    @yield('vuedata')
	<!--Ganti dataMenu.js dibawah ini sesuai kebutuhan. Karena isi menu diletakkan difile dibawah ini.-->
    <script src="/js/menuDosen.js"></script> 
    <script>
	const app = new Vue({
		el : "#app",
		mixins : [dataMix,dataMenu],
		data (){
			return {
				perPage : 10,
				search : null,
				table : {
					tableClass : 'table table-bordered table-striped dataTable',
					ascendingIcon : 'glyphicon glyphicon-chevron-up',
					descendingIcon : 'glyphicon glyphicon-chevron-down',
					handleIcon : 'sorting'
				},
				pagination : {
					wrapperClass : "pagination pagination-sm no-margin pull-right",
					activeClass : "btn-primary",
					loadingClass:   "overlay",
					disabledClass : "disabled",
					pageClass : "btn btn-border",
					linkClass : "btn btn-border",
					infoClass : "pull-left",
					icons : {
						'first': "glyphicon glyphicon-fast-backward",
					    'prev':"glyphicon glyphicon-backward",
					    'next':"glyphicon glyphicon-forward",
					    'last':"glyphicon glyphicon-fast-forward"
					}
				},
				form : {
					pkValue : null,
					mode : 'create'
				},
				modalStatus : false,
				listField : []
				
			}
		},
		created (){
			for(let x = 0;x < this.form.fields.length; x++){
				this.listField.push(this.form.fields[x].name)
			}
		},
		watch: {
			'perPage' (val, oldVal) {
				this.$nextTick(function() {
					this.refreshTable()
				})
			}
		},
		methods : {
			refreshTable (){
				this.$refs.vuetable.refresh()
			},
			onChangePage(page) {
				this.$refs.vuetable.changePage(page)
			},
			onPaginationData(paginationData) {
				this.$refs.pagination.setPaginationData(paginationData)
				this.$refs.paginationInfo.setPaginationData(paginationData)
			},
			onSearch(x) {
				this.appendParams.search = x
				this.$refs.vuetable.refresh()
			},
			onResetSearch(x) {
				this.appendParams.search = undefined
				this.search = ''
				this.$refs.vuetable.refresh()
			},
			resetModel (){
				let model = this.listField;
				for(let x = 0; x < model.length; x++){
					this.form.model[model[x]] = null
				}
			},
			resetModelError (){
				let error = this.listField;
				for(let x = 0; x < error.length; x++){
					this.form.error[error[x]] = null
				}
			},
			resetForm (){
				this.resetModel()
				this.resetModelError()
				this.form.mode = 'create'
				this.form.pkValue = null
			},
			toggleForm (){
				this.resetForm()
				this.modalStatus = !this.modalStatus
			},
			getDataDetail (id){
				let model = Object.keys(this.form.model);
				axios.get(this.url_get+'/'+id)
					.then(res=>{
						this.toggleForm()
						this.resetModelError()
						this.resetModel()
						this.form.mode = 'update'
						let data = res.data.data
						for(let x = 0; x < model.length; x++){
							this.$set(this.form.model, model[x], data[model[x]])
						}
						this.form.pkValue = id
					})
					.catch(err=>{
						console.log(err)
					})
			},
			saveData (){
				if(this.form.mode == 'create' || this.form.mode == 'update'){
					let url, method
					if(this.form.mode == 'create'){
						url = this.url_get
						method = 'post'
					}else if(this.form.mode == 'update'){
						url = this.url_get+'/'+this.form.pkValue
						method = 'put'
					}
					axios[method](url, this.form.model)
						.then(res=>{
							this.toggleForm()
							this.refreshTable()
						})
						.catch(err=>{
							if(err.response.status == 422){
								let errors = err.response.data.error // isi error mentah
								let error = Object.keys(errors) // daftar field yang error
								for(let x = 0; x < error.length; x++){
									this.$set(this.form.error, error[x], errors[error[x]])
								}
							}else {
								this.$notify.danger('Terjadi kesalahan pada server!')
							}
						})
				}else{
					this.$notify.danger('Terjadi kesalahan pada aplikasi!')
				}
			},
			deleteData (id){
				if(confirm("Apakah Anda yakin menghapus data "+id+"?") == true){
					axios.delete(this.url_get+'/'+id)
					.then(res=>{
						this.refreshTable()
					})
					.catch(err=>{
						this.$notify.danger('Terjadi kesalahan pada server!')
					})
				}
			}
		}
	})
	</script>
    <script src="/js/app_adminlte.js"></script>
    </body>
</html>
