require('./bootstrap');

window.Vue = require('vue');

<<<<<<< HEAD
Vue.component('groupe', require('./components/Groupe.vue').default);
Vue.component('type', require('./components/Type.vue').default);
Vue.component('city', require('./components/City.vue').default);
=======
Vue.component('higroupe', require('./components/Higroupe.vue').default);
Vue.component('groupe', require('./components/Groupe.vue').default);
Vue.component('type', require('./components/Type.vue').default);
Vue.component('city', require('./components/City.vue').default);
Vue.component('role', require('./components/Role.vue').default);
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
Vue.component('empresa', require('./components/Empresa.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('category', require('./components/Category.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('cliente', require('./components/Cliente.vue').default);

Vue.component('search', require('./frontend/Search.vue'));

const app = new Vue({
  el: '#app',
  data :{
		menu : 0,
		page : 0
  }
});



