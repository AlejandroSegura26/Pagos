

window.Vue = require('vue');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.component('hitos-component', require('./components/HitosComponent.vue').default);
Vue.component('tareas-component', require('./components/AlumnosComponent.vue').default);
Vue.component('alum', require('./components/AlumnosComponent.vue').default);
Vue.component('colegiaturas', require('./components/ColegiaturasComponent.vue').default);
Vue.component('servicios', require('./components/ServiciosComponent.vue').default);
Vue.component('pagoscolegiaturas', require('./components/PagosColegiaturasComponent.vue').default);
Vue.component('estadocuenta', require('./components/EstadoCuentaComponent.vue').default);
Vue.component('rentas', require('./components/RentasComponent.vue').default);
Vue.component('compras', require('./components/ComprasComponent.vue').default);
const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
    }
});