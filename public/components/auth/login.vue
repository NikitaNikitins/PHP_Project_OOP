<template>
    <div>
        <div>
            <h1>Please sign in</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <b-form @submit.prevent="submit">
                    <v-form-group :validator="$v.username" label="Username">
                        <b-form-input v-model="username" placeholder="Enter username" />
                    </v-form-group>
                    <v-form-group :validator="$v.password" label="Username">
                        <b-form-input type="password" v-model="password" placeholder="Enter Pasword" />
                    </v-form-group>
                    <div class="form-group">
                        <b-btn type="submit" class="btn btn-signin">Sign in</b-btn>
                    </div>
                </b-form>
            </div>
        </div>
    </div>
</template>

<script>
    import { required } from 'vuelidate/lib/validators';

    export default {
        data() {
            return {
                username: '',
                password: '',
            }
        },

        validations: {
            username: {
                required
            },
            password: {
                required
            }
        },

        methods: {
            onSubmit() {
                console.log(this.password);
                console.log(this.username);
            }
        }
    }
</script>