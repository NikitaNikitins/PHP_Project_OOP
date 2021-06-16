<template>
    <div class="container">
        <h3 class="mt-5">
            User list
        </h3>
        <div class="row">
            <div class="col-12">
                <table class="user-list-table table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Enabled</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="!isLoading">
                        <tr v-for="user in users" :key="user.Id">
                            <td>{{user.UserName}}</td>
                            <td>{{user.Email}}</td>
                            <td>{{user.PhoneNumber}}</td>
                            <td>{{user.FullName}}</td>
                            <td>{{getUserEnabled(user.IsEnabled)}}</td>
                            <td>{{getUserRole(user.RoleId)}}</td>
                            <td class="actions">
                                <button type="button" class="btn btn-primary" @click="previewUser(user.Id)"><icon type="preview-icon"/></button>
                                <button type="button" class="btn btn-success" @click="editUser(user.Id)"><icon type="edit-icon"/></button>
                                <button type="button" class="btn btn-danger" @click="deleteUser(user.Id)"><icon type="delete-icon"/></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <preview-user-modal ref="previewUser"></preview-user-modal>
        <edit-user-modal ref="editUser" @success="userIsEdit"/>
    </div>
</template>

<script>
import usersService from 'api-services/users-service';
import { UserRole, BooleanInText} from 'store/constants';
import previewUserModal from '../common/modal-windows/preview-user-modal';
import editUserModal from '../common/modal-windows/edit-user-modal';

export default {
    data() {
        return {
            isLoading: true,
            users: [],
            booleanInText: BooleanInText,
            userRoles: UserRole
        }
    },

    components: {
        previewUserModal,
        editUserModal
    },

    async mounted() {
        this.users = await usersService.getUserList();
        this.isLoading = false;
    },

    methods: {
        previewUser(userId) {
            this.$refs.previewUser.show(userId);
        },

        editUser(userId) {
            this.$refs.editUser.show(userId);
        },

        async deleteUser(userId){
            let res = await usersService.deleteUser(userId);
            this.users.splice(this.users.findIndex(user => parseInt(user.Id) === parseInt(userId)), 1);
            this.$toasted.show(res.message);
        },

        getUserEnabled(isEnabled) {
            return this.booleanInText.find(val =>val.value === parseInt(isEnabled)).text;
        },

        getUserRole(userRoleId) {
            return this.userRoles.find(role => role.value === parseInt(userRoleId)).text;
        },

        async userIsEdit() {
            this.users = await usersService.getUserList();
        }
    }
}
</script>
