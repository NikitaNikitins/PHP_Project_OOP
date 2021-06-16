import Vue from 'vue';

const usersService = {
    async getRegisterFormOptions() {
        return (await Vue.axios.get('/users/getRegisterFormOptions')).data;
    },

    async getUserList() {
        return (await Vue.axios.get('/users/getUserList')).data;
    },

    async getUserById(userId) {
        return (await Vue.axios.get('/users/getUserById', {params: {userId}})).data; 
    },

    async deleteUser(userId) {
        return (await Vue.axios.delete("/users/"+userId )).data;
    },

    async editUserData(data) {
        return (await Vue.axios.post('/users/edit', data)).data;
    }
}

export default usersService;