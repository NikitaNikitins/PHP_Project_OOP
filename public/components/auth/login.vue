<template>
    <div class="login-wrapper">
        <div class="card-header">
            <h1 class="card-title">Sign In</h1>
        </div>
        <div class="card card-login">
            <div class="card-body">
                <b-form @submit.prevent="submit">
                    <b-form-group :validator="$v.data.username" label="Username">
                        <b-form-input v-model="data.username" placeholder="Enter username" />
                    </b-form-group>
                    <b-form-group :validator="$v.data.password" label="Password">
                        <b-form-input type="password" v-model="data.password" placeholder="Enter Pasword" />
                    </b-form-group>
                    <div class="form-group">
                        <b-btn type="submit" class="btn btn-signin">Sign in</b-btn>
                    </div>
                </b-form>
            </div> 
        </div>
    </div>
</template>

<script>
    import authService from 'api-services/auth-service';

    import { required } from 'vuelidate/lib/validators';
    import formMixin from 'mixins/form-mixin';

    export default {
        mixins: [formMixin],

        data() {
            return {
                data: {
                    username: '',
                    password: '',
                }
            }
        },

        validations: {
            data :{
                    username: {
                    required
                },
                password: {
                    required
                }
            }
        },

        // created() {
        //     this.$emit('hideNavigationBar', true);
        // },

        // destroyed() {
        //     this.$emit('hideNavigationBar', false);
        // },

        methods: {
            async submit() {
                await authService.login(this.data);
            }
        }
    }
</script>