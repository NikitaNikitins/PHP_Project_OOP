<template>
    <div class="container">
        <h3 class="mt-5">
            workers list
        </h3>
        <div class="row">
            <div class="col-12">
                <table class="user-list-table table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Email</th>
                            <th scope="col">BankAccount</th>
                            <th scope="col">SalaryPerHour</th>
                        </tr>
                    </thead>
                    <tbody v-if="!isLoading">
                        <tr v-for="worker in workers" :key="worker.Id">
                            <td>{{worker.FirstName}}</td>
                            <td>{{worker.LastName}}</td>
                            <td>{{worker.PhoneNumber}}</td>
                            <td>{{worker.Email}}</td>
                            <td>{{worker.BankAccount}}</td>
                            <td>{{worker.SalaryPerHour}}</td>
                            <td class="actions">
                                <button type="button" class="btn btn-success" @click="editWorker(worker.Id)"><icon type="edit-icon"/></button>
                                <button type="button" class="btn btn-danger" @click="deleteWorker(worker.Id)"><icon type="delete-icon"/></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <edit-worker-modal ref="editWorker"/>
    </div>
</template>

<script>
import workerServce from 'api-services/workers-service';
import editWorkerModal from '../common/modal-windows/edit-worker-modal';

export default {
    data() {
        return {
            isLoading: true,
            workers: []
        }
    },

    components: {
        editWorkerModal
    },

    async mounted() {
        this.workers = await workerServce.getWorkersList();
        this.isLoading = false;
    },

    methods: {
        editWorker(workerId) {
            this.$refs.editWorker.show(workerId);
        },

        async deleteWorker(workerId){
            let res = await workerServce.deleteWorker(workerId);
            this.workers.splice(this.workers.findIndex(worker => parseInt(worker.Id) === parseInt(workerId)), 1);
            this.$toasted.show(res.message);
        }
    }
}
</script>
