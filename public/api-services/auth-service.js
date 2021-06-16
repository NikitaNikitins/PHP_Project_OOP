import Vue from 'vue';

const authService = {
    async registerUser(data) {
        return (await Vue.axios.post('/auth/register', data)).data;
    },
    
    async login(data) {
        return (await Vue.axios.post('/auth/login', data)).data;
    }
}

export default authService;