<template>
    <div>
        <nav-menu v-if="showNavigationBar"></nav-menu>
        <router-view @hideNavigationBar="onHideNavigationBar"/>
    </div>
</template>

<script>
import Vue from 'vue';

import NavMenu from './nav-menu';

Vue.component('nav-menu', NavMenu);

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
