require('./bootstrap');
window.Vue = require('vue');
// global.jQuery = require('jquery');
require('bootstrap');
require('axios');

const $ = require( "jquery" )( window );

Vue.component('usuarios', require('./components/Usuarios.vue').default);
Vue.component('usuarios-listado', require('./components/UsuariosListado.vue').default);
Vue.component('usuarios-agregar', require('./components/UsuariosAgregar.vue').default);

Vue.use(axios);

window.lego = new Vue({
    el: '#app',
    data(){
        return {
            messages:'sas'
        }
    },
    components:{
        //'datepicker': Buefy.Datepicker
    },
});