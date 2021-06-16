<template>
    <b-modal ref="modal" title="Edit user" no-close-on-esc no-close-on-backdrop v-if="isLoaded">
        <b-form-group label="Username">
            <b-form-input v-model="data.UserName" />
        </b-form-group>
        <b-form-group label="Email">
            <b-form-input v-model="data.Email" />
        </b-form-group>
        <b-form-group label="Phone number">
            <b-form-input v-model="data.PhoneNumber" />
        </b-form-group>
        <b-form-group label="First name">
            <b-form-input v-model="data.FirstName" />
        </b-form-group>
        <b-form-group label="Last name">
            <b-form-input v-model="data.LastName" />
        </b-form-group>
        <b-form-group label="Address">
            <b-form-input v-model="data.Address" />
        </b-form-group>
        <b-form-group label="City">
            <b-form-input v-model="data.City" />
        </b-form-group>
        <b-form-group label="Select country">
            <b-form-select v-model="data.CountryId" :options="countryOptions">
            </b-form-select>
        </b-form-group>
        <b-form-group label="Select user role">
            <b-form-select v-model="data.RoleId" :options="userRoles">
            </b-form-select>
        </b-form-group>
        <div slot="modal-footer">
            <b-btn @click="cancel" variant="secondary">Cancel</b-btn>
            <b-btn variant="primary" @click="submit">Submit</b-btn >
        </div>
    </b-modal>
</template>

<script>
import modalsMixin from 'mixins/modals-mixin';
import userService from 'api-services/users-service';
import { UserRole } from 'store/constants.js';

export default {
    mixins: [modalsMixin],

    data(){
        return {
            isLoaded: false,
            data: null,
            countryOptions: [],
            userRoles: []
        }
    },

    methods: {
        async beforeShow(userId) {
            this.data = await userService.getUserById(userId);

            let countryOptions = await userService.getRegisterFormOptions();
            
            this.countryOptions = countryOptions.map(opt => { return {
                text: `${opt.Name} - ${opt.Code}`,
                value:  parseInt(opt.Id)
                }
            });

            this.userRoles = UserRole;

            this.isLoaded = true;
        },

        async onSubmit() {
            let res = await userService.editUserData(this.data);
            
            this.$toasted.show(res.message);
        }
    }
}
</script>
