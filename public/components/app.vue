<template>
    <div>
        <div class="home-page-nav">
            <nav-menu></nav-menu>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';

import NavMenu from './nav-menu';
Vue.component('nav-menu', NavMenu);

export default {
    data() {
        return {
        }
    },
}
</script>
