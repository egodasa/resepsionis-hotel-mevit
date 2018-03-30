/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap'
import Vue from 'vue'
//~ import tabs from './components/master/tabs.vue'
//~ import tab from './components/master/tab.vue'
//~ import alert from './components/master/alert.vue'
//~ import formGenerator from './components/master/formGenerator.vue'
import Notify from 'vue2-notify'
import store from 'store'
import vuecookies from 'vue-cookies'
import VueRouter from 'vue-router'



import login from './views/login.vue'

import adminLayout from './views/admin/layout.vue'
import baseLayout from './views/layout.vue'

//Halaman admin
import indexAdmin from 		'./views/admin/index.vue'
import daftarKamar from 	'./views/admin/KelolaDaftarKamar.vue'
import tipeKamar from 		'./views/admin/kelolaTipeKamar.vue'
import daftarPemesan from 	'./views/admin/kelolaDaftarPemesan.vue'
import kelolaUser from 		'./views/admin/kelolaUser.vue'

//GLOBAL COMPONENTS
import content from './components/spa/content.vue'
import header from './components/spa/header.vue'
import sidebar from './components/spa/sidebar.vue'
import footer from './components/spa/footer.vue'
import formGenerator from './components/master/formGenerator.vue'
import modal from './components/master/modal.vue'

window.Vue = Vue;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter)
Vue.use(Notify, {
	position: 'bottom-right'
})
Vue.component('modal', modal);
Vue.component('sidebar-section', sidebar);
Vue.component('header-section', header);
Vue.component('content-section', content);
Vue.component('footer-section', footer);
Vue.component('form-generator', formGenerator);

const cks = {
	setCookies(x, y, z = null) {
		z == null ? vuecookies.set(x, y) : vuecookies.set(x, y, z)
	},
	getCookies(x) {
		return vuecookies.get(x)
	},
	clearCookies(x) {
		vuecookies.remove(x)
	},
	isCookies(x) {
		return vuecookies.isKey(x)
	}
}
const localStorage = {
	setLcs(x, y) {
		store.set(x, y)
	},
	getLcs(x) {
		return store.get(x)
	},
	clearLcs() {
		store.clearAll()
	},
	removeLcs(x) {
		store.remove(x)
	}
}
Vue.prototype.$lcs = localStorage
Vue.prototype.$cks = cks

const routes = [{
		path: '/',
		component: baseLayout,
		children : [
			{
				path : '/',
				component : login
			}
		]
	},
	{
		path: '/admin',
		component: adminLayout,
		children : [
			{
				path: '/',
				component: indexAdmin
			},
			{
				path: 'daftar-kamar',
				component: daftarKamar
			},
			{
				path: 'tipe-kamar',
				component: tipeKamar
			},
			{
				path: 'daftar-pemesan',
				component: daftarPemesan
			},
			{
				path: 'user',
				component: kelolaUser
			}
		]
	}
]

const router = new VueRouter({
	routes // short for `routes: routes`
})

const app = new Vue({
	router
}).$mount('#app')
