<template>
    <div>
        <div class="home-page-nav">
            <home-page-representative/>
        </div>
        <div class="home-page-info container">
            <home-page />
        </div>
    </div>
</template>

<script>
import Vue from 'vue';

import homePageRepresentative from 'components/home/home-page-representative';
import homePage from 'components/home/home-page'

Vue.component('home-page-representative', homePageRepresentative);
Vue.component('home-page', homePage);

export default {
    data() {
        return {
        }
    },
}
</script>
