/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


import VueLoading from "vue-loading-overlay";
import SimpleVueValidation from 'simple-vue-validator';

Vue.mixin({
    data: function (){
        return {
            isLoading: false,
            Validator: SimpleVueValidation.Validator,
            token:  null
        }
    },
    methods:{
        makeAjaxCall: function(url, methodType,data){
            const self = this

            return $.ajax({
                url : url,
                method : methodType,
                dataType : "json",
                data: data,
                beforeSend: () => self.isLoading = true,
                complete: () => self.isLoading = false,
                error : function (reason, xhr){
                    console.log("error in processing your request", reason);
                }
            });
        }
    },
    mounted() {
        this.token = $('meta[name="csrf-token"]').attr('content')
    }
});



Vue.use(VueLoading);
Vue.use(SimpleVueValidation);

Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('leads-component', require('./components/LeadsComponent.vue').default);
Vue.component('loading', VueLoading);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
