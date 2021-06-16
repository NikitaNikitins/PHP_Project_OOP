<template>
    <b-modal ref="modal" title="Edit worker" no-close-on-esc no-close-on-backdrop v-if="isLoaded">
        <b-form-group label="First name">
            <b-form-input v-model="data.FirstName" />
        </b-form-group>
        <b-form-group label="Last name">
            <b-form-input v-model="data.LastName" />
        </b-form-group>
        <b-form-group label="Phone number">
            <b-form-input v-model="data.PhoneNumber" />
        </b-form-group>
        <b-form-group label="Email">
            <b-form-input v-model="data.Email" />
        </b-form-group>
        <b-form-group label="Bank Account">
            <b-form-input v-model="data.BankAccount" />
        </b-form-group>
        <b-form-group label="Salary per hour">
            <b-form-input v-model="data.SalaryPerHour" />
        </b-form-group>
        <div slot="modal-footer">
            <b-btn @click="cancel" variant="secondary">Cancel</b-btn>
            <b-btn variant="primary" @click="submit">Submit</b-btn >
        </div>
    </b-modal>
</template>

<script>
import modalsMixin from 'mixins/modals-mixin';
import workersService from 'api-services/workers-service';

export default {
    mixins: [modalsMixin],

    data(){
        return {
            isLoaded: false,
            data: null
        }
    },

    methods: {
        async beforeShow(workerId) {
            this.data = await workersService.getWorkerById(workerId);
            this.isLoaded = true;
        },

        async onSubmit() {
            let res = await workersService.editWorkerData(this.data);
            
            this.$toasted.show(res.message);
        }
    }
}
</script>
