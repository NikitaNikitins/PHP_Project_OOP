import Vue from 'vue';

//bootstrap plug-in
import BootstrapVue from 'bootstrap-vue/esm/index.js';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import app from 'components/app';
import icon from 'components/common/icons/icon';
import svgIcon from 'components/common/icons/svg-icon';

import router from './router';

Vue.use(router);

Vue.use(BootstrapVue);

Vue.component('icon', icon);
Vue.component('svg-icon', svgIcon);

new Vue({
    el: '#app',
    router,
    ...app
});