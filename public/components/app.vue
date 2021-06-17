<template>
    <div>
        <nav-menu v-if="showNavigationBar"></nav-menu>
        <router-view @hideNavigationBar="onHideNavigationBar"/>
        <page-footer />
    </div>
</template>

<script>
import Vue from 'vue';

import NavMenu from './nav-menu';
import pageFooter from './page-footer';

Vue.component('nav-menu', NavMenu);
Vue.component('page-footer', pageFooter);

export default {
    data() {
        return {
            showNavigationBar: true
        }
    },

    methods: {
        onHideNavigationBar(value) {
            this.showNavigationBar = !value;
        }
    }
}
</script>
