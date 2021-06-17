<template>
    <div class="completed-projects-wrapper container">
        <div class="d-flex flex-row-reverse mt-5 mb-5">
            <b-btn-loading :variant="'btn btn-primary'" @click.native="addProject"
            :isLoading="isLoading"
            :text="'Add new completed project'">
            </b-btn-loading>
        </div>
        <img :src="mainCardImg" alt="" />
        <article class="mt-3">
            <h1>Lorem ipsum dolor sit.</h1>
            <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti quisquam facilis hic. Architecto repudiandae corrupti rem unde minus nihil facere, aperiam laboriosam dicta explicabo, minima sequi quas! Minima, quam id.</h4>
        </article>
        <div class="completed-projects-container" v-if="!isLoading">
            <created-project-item :data="project" v-for="project in completedProjects" :key="project.Id"/>
        </div>
        <add-completed-project-modal ref="addCompletedProject" @sucess="completedProjectAdded"></add-completed-project-modal>
    </div>
</template>

<script>
import Vue from 'vue';
import orderedProjectsService from 'api-services/ordered-projects-service';
import createdProjectItem from '../common/components/created-project-item';
import addCompletedProjectModal from '../common/modal-windows/create-new-completed-project';

    export default {
        // City, Address, PlannedEndDate, StartDate
        data(){
            return {
                mainCardImg: require('components/common/images/created-projects-main.png'),
                completedProjects: [],
                isLoading: true
            }
        },

        components: {
            createdProjectItem,
            addCompletedProjectModal
        },

        async mounted() {
            this.completedProjects = await orderedProjectsService.getFinishedProjects();

            this.isLoading = false;
        },

        methods: {
            addProject() {
                this.$refs.addCompletedProject.show();
            },

            async completedProjectAdded() {
                this.isLoaded = true;
                this.completedProjects = await orderedProjectsService.getFinishedProjects();
                this.isLoaded = false;
            }
        }
    }
</script>
