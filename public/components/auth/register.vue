<template>
    <div class="container">
        <div class="d-flex flex-row-reverse mt-5 mb-5">
            <router-link to="/userList">
                <b-btn variant="warning">Go to user list</b-btn>
            </router-link>
        </div>
        <div class="login-wrapper">
            <div class="card-header">
                <h1 class="card-title">Register</h1>
            </div>
            <div class="card card-login">
                <div class="card-body">
                    <b-form @submit.prevent="submit" v-if="isLoaded">
                        <validation-errors :errors="errors"></validation-errors>
                        <v-form-group :validator="$v.data.firstName" label="First Name" label-required>
                            <b-form-input v-model="data.firstName" placeholder="Enter first name" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.lastName" label="Last Name" label-required>
                            <b-form-input v-model="data.lastName" placeholder="Enter last name" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.email" label="Email" label-required>
                            <b-form-input v-model="data.email" placeholder="Enter email address" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.password" label="Password" label-required>
                            <b-form-input type="password" v-model="data.password" placeholder="Enter Pasword" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.phone" label="Phone" label-required>
                            <b-form-input v-model="data.phone" placeholder="Enter phone number" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.city" label="City" label-required>
                            <b-form-input v-model="data.city" placeholder="Enter city" />
                        </v-form-group>
                        <v-form-group :validator="$v.data.address" label="Address" label-required>
                            <b-form-input v-model="data.address" placeholder="Enter address" />
                        </v-form-group>
                        <v-form-group label="Select country" label-required>
                            <b-form-select v-model="data.countryId" :options="countryOptions">
                                <template #first>
                                    <b-form-select-option :value="null" disabled>Please select country</b-form-select-option>
                                </template>
                            </b-form-select>
                        </v-form-group>
                        <v-form-group label="Select user role" label-required>
                            <b-form-select v-model="data.userRole" :options="userRoles">
                                <template #first>
                                    <b-form-select-option :value="null" disabled>Please select user role</b-form-select-option>
                                </template>
                            </b-form-select>
                        </v-form-group>
                        <div class="form-group">
                            <b-btn type="submit" class="btn btn-signin">Register</b-btn>
                        </div>
                    </b-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { required } from 'vuelidate/lib/validators';
    import formMixin from 'mixins/form-mixin';
    import authService from 'api-services/auth-service';
    import usersService from 'api-services/users-service';
    import { UserRole } from 'store/constants.js';

    export default {
        mixins: [formMixin],

        data() {
            return {
                isLoaded: false,
                data: {
                    firstName: '',
                    lastName: '',
                    email: '',
                    userName: '',
                    password: '',
                    userRole: '',
                    phone: '',
                    address: '',
                    city: '',
                    countryId: null
                },
                userRoles: [],
                countryOptions: []
            }
        },

        async mounted() {
            let registerFormOptions = await usersService.getRegisterFormOptions();

            this.countryOptions = registerFormOptions.map(opt => { return {
                text: `${opt.Name} - ${opt.Code}`,
                value:  parseInt(opt.Id)
                }
            });

            this.isLoaded = true;
        },

        // created() {
        //     this.$emit('hideNavigationBar', true);
        // },

        // destroyed() {
        //     this.$emit('hideNavigationBar', false);
        // },

        validations: {
            data: {
                firstName: {
                    required
                },
                lastName: {
                    required
                },
                email: {
                    required
                },
                password: {
                    required
                },
                phone: {
                    required
                },
                city: {
                    required
                },
                address: {
                    required
                }
            },
            repeatedPassword: {
                required
            }
        },

        created(){
            this.userRoles = UserRole;
        },

        methods: {
            async onSubmit() {
                this.data.userName  = this.data.email;
                let res = await authService.registerUser(this.data);

                this.$toasted.show(res.message);
                this.$router.push({ name: 'users'})
            }
        }
    }
</script>
