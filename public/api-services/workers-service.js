import Vue from 'vue';

const workersService = {
    async getWorkersList() {
        return (await Vue.axios.get('/workers/getWorkersList')).data;
    },

    async getWorkerById(workerId) {
        return (await Vue.axios.get('/workers/getWorkerById', {params: {workerId}})).data; 
    },

    async deleteWorker(workerId) {
        return (await Vue.axios.delete("/workers/"+workerId )).data;
    },

    async editWorkerData(data) {
        return (await Vue.axios.post('/workers/edit', data)).data;
    }
}

export default workersService;