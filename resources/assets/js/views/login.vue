<template>
<content-section>
<template slot="contentHeader">
	<div class="login-box">
	  <div class="login-logo">
	    <a href="">HOTEL <b>MEVIT</b></a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body" id="app">
	    <p class="login-box-msg">Login untuk masuk ke aplikasi</p>
	
	    <form @submit.prevent="checkLogin">
	      <div class="form-group has-feedback">
	        <input type="text" class="form-control" placeholder="Username" v-model="login.username">
	        <span class="glyphicon glyphicon-user form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" placeholder="Password" v-model="login.password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="btnLogin.disabled">{{btnLogin.text}}</button>
	      </div>
	      
	    </form>
	  </div>
	</div>
</template>
</content-section>
</template>
<script>
export default{
	name : 'login',
	data (){
		return {
			login : {
				username : "",
				password : ""
			},
			btnLogin : {
				text : "Login",
				disabled : false
			}
		}
	},
	methods : {
		checkLogin (){
			if(this.login.username != "" && this.login.password != ""){
				this.toggleFormLogin()
				axios.post('/api/login',this.login)
					.then(res=>{
						if(res.data.status == true){
							this.$lcs.setLcs('info_login',res.data.data[0])
							if(res.data.data[0].tipe == 'Admin') this.$router.push('/admin')
							else if(res.data.data[0].tipe == 'Resepsionis') this.$router.push('/transaksi')
						}
						this.toggleFormLogin()
					})
					.catch(err=>{
						this.$notify.danger('Terjadi kesalahan pada aplikasi!')
						this.toggleFormLogin()
					})
			}
		},
		toggleFormLogin(){
			this.btnLogin.disabled = !this.btnLogin.disabled
			if(this.btnLogin.disabled == true){
				this.btnLogin.text = "Tunggu Sebentar..."
			}else {
				this.btnLogin.text = "Login"
			}
		}
	}
}
</script>
