<template>
    <div>
        <div class="home-page-nav">
            <nav-menu></nav-menu>
            <home-page-representative/>
        </div>
        <div class="home-page-info container">
            <home-page />
        </div>
    </div>
</template>

<script>
import Vue from 'vue';

import NavMenu from './nav-menu';
import homePageRepresentative from 'components/home/home-page-representative';
import homePage from 'components/home/home-page'

Vue.component('nav-menu', NavMenu);
Vue.component('home-page-representative', homePageRepresentative);
Vue.component('home-page', homePage);

export default {
    data() {
        return {
        }
    },
}
</script>
