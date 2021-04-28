<template>
    <div class="main-navbar" :class="{sticked_navbar_color: scrollPosition > 50 }">
        <b-navbar toggleable="lg">
            <b-navbar-brand href="#" class="ml-5">
                <icon type="main-logo"></icon>
            </b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="ml-auto mr-4">
                    <b-nav-item class="font-weight-bold" href="#">Home</b-nav-item>
                    <b-nav-item href="#">Completed Projects</b-nav-item>
                    <b-nav-item href="#">Services</b-nav-item>
                    <b-nav-item href="#">Contact Us</b-nav-item>
                    <b-nav-item to="/login">Login
                        <icon type="login-icon"></icon>
                    </b-nav-item>
                    <b-nav-item href="#">Register
                        <icon type="register-icon"></icon>
                    </b-nav-item>
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
    .sticked_navbar_color{
            background-color: #fff;

            .navbar-nav{
                .nav-link {
                    border: none;
                }
            }
        }
</style>