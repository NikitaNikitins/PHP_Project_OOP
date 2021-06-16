<template>
    <div class="completed-projects-card">
        <img class="card-img" :src="data.MainImage" alt="">
        <div class="card-content">
            <div class="project-info ">
                <span><icon type="clock-icon"/> {{data.TimeSpent}} months</span>
                <span><icon type="group-icon" /> {{data.EmployedCount}} members</span>
                <span><icon type="location-icon" /> {{data.City}}</span>
            </div>
            <h4>{{data.Title}}, {{data.City}}</h4>
            <p>{{data.Text}}</p>
        </div>
        <footer class="row justify-content-between" v-if="isEditable">
            <b-btn variant="outline-info col-3">Info</b-btn>
            <b-btn variant="outline-warning col-3">Edit</b-btn>
            <b-btn variant="outline-danger col-3" @click="deleteProject">Delete</b-btn>
        </footer>
    </div>
</template>

<script>
import orderedProjectsService from 'api-services/ordered-projects-service';

export default{
    props: {
        data: null,
        isEditable: {
            type: Boolean,
            default: true
        }
    },

    data() {
        return {
        }
    },

    methods: {
        async deleteProject() {
            let res = await orderedProjectsService.deleteProject(parseInt(this.data.Id));
            this.$toasted.show(res);
        }
    }
}

</script>
