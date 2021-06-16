<template>
    <b-modal ref="modal" title="Preview user" no-close-on-esc no-close-on-backdrop v-if="isLoaded">
        <b-form-group label="Username">
            <b-form-input v-model="data.UserName" disabled />
        </b-form-group>
        <b-form-group label="Email">
            <b-form-input v-model="data.Email" disabled />
        </b-form-group>
        <b-form-group label="Phone number">
            <b-form-input v-model="data.PhoneNumber" disabled />
        </b-form-group>
        <b-form-group label="First name">
            <b-form-input v-model="data.FirstName" disabled />
        </b-form-group>
        <b-form-group label="Last name">
            <b-form-input v-model="data.LastName" disabled />
        </b-form-group>
        <b-form-group label="Address">
            <b-form-input v-model="data.Address" disabled />
        </b-form-group>
        <b-form-group label="City">
            <b-form-input v-model="data.Address" disabled />
        </b-form-group>
        <b-form-group label="Country">
            <b-form-input v-model="data.Name" disabled />
        </b-form-group>
        <b-form-group label="Country code">
            <b-form-input v-model="data.Code" disabled />
        </b-form-group>
    </b-modal>
</template>

<script>
import modalsMixin from 'mixins/modals-mixin';
import userService from 'api-services/users-service';

export default {
    mixins: [modalsMixin],

    data(){
        return {
            isLoaded: false,
            data: null
        }
    },

    methods: {
        async beforeShow(userId) {
            this.data = await userService.getUserById(userId);
            this.isLoaded = true;
        }
    }
}
</script>
