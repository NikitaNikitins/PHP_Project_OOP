<template>
    <div class="main-navbar" :class="{sticked_navbar_color: scrollPosition > 50 }">
        <b-navbar toggleable="lg">
            <b-navbar-brand href="#" class="ml-5">
                <icon type="main-logo"></icon>
            </b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="ml-auto mr-4">
                    <router-link to="/" class="nav-link font-weight-bold">Home</router-link>
                    <router-link to="/completedProjects" class="nav-link font-weight-bold">Completed Projects</router-link>

                    <router-link to="/create-database-sql" class="nav-link font-weight-bold">Datubāzes izveidošanas skripts</router-link>
                    <router-link to="/er-diagram" class="nav-link font-weight-bold">ER diagramma</router-link>
                    <router-link to="/stored-functions" class="nav-link font-weight-bold">Funkcijas</router-link>
                    <router-link to="/stored-procedures" class="nav-link font-weight-bold">Procedūras</router-link>
                    <router-link to="/created-triggers" class="nav-link font-weight-bold">Triggeri</router-link>
                    <!-- <router-link to="/services" class="nav-link font-weight-bold">Services</router-link>
                    <b-nav-item href="#">Contact Us</b-nav-item> -->
                    <router-link to="/login" class="nav-link">Login
                        <icon type="login-icon"></icon>
                    </router-link>
                    <router-link to="/register" class="nav-link font-weight-bold">Register
                        <icon type="register-icon"></icon>
                    </router-link>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
import icon from './common/icons/icon.vue'
    export default {
        data() {
            return {
                scrollPosition: null
            }
        },

        components: { icon },

        mounted() {
            window.addEventListener('scroll', this.updateScroll);
        },

        methods: {
            updateScroll() {
                this.scrollPosition = window.scrollY
            }
        }
    }
</script>

<style scoped lang="scss">
    .sticked_navbar_color {
        background-color: #fff;
    }
</style>
