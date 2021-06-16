import Vue from 'vue';

const orderedProjectsService = {
    async getOrderedProjects() {
        return (await Vue.axios.get('/orderedProjects')).data;
    },

    async getOrderedProjectById(id){
        return (await Vue.axios.get('/orderedProjects', {params: {id}})).data;
    },

    async getFinishedProjects() {
        return (await Vue.axios.get('/finishedProjects')).data;
    },

    async finishProject(id){
        return (await Vue.axios.get(`/orderedProjects/finishProject/${id}`)).data;
    },

    async getOrderedProjectsToFinish() {
        return (await Vue.axios.get('/orderedProjects/getProjectsToFinish')).data;
    },

    async createNewFinishedProject(data) {
        return (await Vue.axios.post('/orderedProjects/createNewFinishedProject', data)).message;
    },

    async deleteProject(id) {
        return (await Vue.axios.delete("/orderedProjects/"+id )).message;
    },
}

export default orderedProjectsService;
