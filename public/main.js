import Vue from 'vue';

//bootstrap plug-in
import BootstrapVue from 'bootstrap-vue/esm/index.js';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import validationErrors from 'components/common/validation-errors.vue';

//axios
import axios from 'axios';
import VueAxios from 'vue-axios';

//vuelidate
import Vuelidate from 'vuelidate';
import VuelidateErrorExtractor from 'vuelidate-error-extractor';

import Toasted from 'vue-toasted';
Vue.use(Toasted);

import app from 'components/app';
import icon from 'components/common/icons/icon';
import svgIcon from 'components/common/icons/svg-icon';
import vuelidateErrorExtractorTemplate from 'components/common/vuelidate/vuelidate-error-extractor-template';
require("babel-polyfill");

import router from './router';

Vue.use(router);

Vue.use(BootstrapVue);

Vue.use(VueAxios, axios);
Vue.axios.defaults.baseURL = 'http://localhost/php_project/PHP_Project_OOP/private';

Vue.use(Vuelidate);

Vue.use(VuelidateErrorExtractor, {
    name: 'v-form-group',
    template: vuelidateErrorExtractorTemplate,
    messages: {
        required: 'The {label} field is required.'
    }
});

Vue.component('icon', icon);
Vue.component('svg-icon', svgIcon);
Vue.component('validation-errors', validationErrors);

new Vue({
    el: '#app',
    router,
    ...app
});
