<template>
    <b-modal ref="modal" title="Add Completed Project" no-close-on-esc no-close-on-backdrop v-if="isLoaded">
        <b-form-checkbox v-model="isAddingNew" @change="data.selectedProject = null" class="mb-3">
            Create new completed project
        </b-form-checkbox>
        <b-form @submit.prevent="submit">
            <b-form-group label="Project title">
            <b-form-input v-model="data.title" placeholder="Enter project title" />
            </b-form-group>
            <b-form-group label="Project description">
                <b-form-textarea v-model="data.description" rows="3" max-rows="6" placeholder="Enter project description" />
            </b-form-group>
            <b-form-group :disabled="!isAddingNew" label="Project start date">
                <b-form-datepicker v-model="data.startDate" class="mb-2"/>
            </b-form-group>
            <b-form-group label="Project finish date">
                <b-form-datepicker v-model="data.finishDate" class="mb-2"/>
            </b-form-group>
            <b-form-group label="Employed count">
                <b-form-input v-model="data.employedCount" :number="true" placeholder="Enter employed count" />
            </b-form-group>
            <b-form-group :disabled="!isAddingNew" label="City">
                <b-form-input v-model="data.city" placeholder="Enter city" />
            </b-form-group>
            <b-form-group :disabled="!isAddingNew" label="Address">
                    <b-form-input v-model="data.address" placeholder="Enter address" />
            </b-form-group>

            <b-form-group label="Select existing project" v-if="!isAddingNew">
                <b-form-select v-model="data.selectedProject" :options="options" @change="onProjectSelected">
                    <template #first>
                        <b-form-select-option :value="null" disabled>Please select existing project</b-form-select-option>
                    </template>
                </b-form-select>
            </b-form-group>
            <div>
                <file-drag-and-drop @uploadAction="uploadAction"/>
            </div>
        </b-form>
        <div slot="modal-footer">
            <b-btn @click="cancel" variant="secondary">Cancel</b-btn>
            <b-btn variant="primary" @click="submit">Submit</b-btn >
        </div>
    </b-modal>
</template>

<script>
import modalsMixin from 'mixins/modals-mixin';
import orderedProjectsService from 'api-services/ordered-projects-service';
import fileDragAndDrop from 'components/common/components/file-drag-and-drop'

export default {
    mixins: [modalsMixin],

    components: {
        'file-drag-and-drop': fileDragAndDrop
    },

    data(){
        return {
            isAddingNew: true,
            isLoaded: false,
            options: [],
            data: {
                title: '',
                description: '',
                startDate: '',
                finishDate: '',
                employedCount: '',
                selectedProject: '',
                address: '',
                city: '',
                projectImages: []
            },
            orderedProjects: null,
        }
    },

    methods: {
        async beforeShow(params) {
            this.orderedProjects = await orderedProjectsService.getOrderedProjectsToFinish();

            this.options = this.orderedProjects.map(project => { return {
                text: `${project.FullName}, ${project.Address}, ${project.City}`,
                value:  parseInt(project.Id),
                startDate: project.StartDate,
                address: project.Address,
                city: project.City
                }
            });

            this.isLoaded = true;
        },

        async onSubmit() {
            let res = await this.addFinishedProject();
            this.$toasted.show(res);
        },

        onProjectSelected(value) {
            let selectedProject = this.options.find(opt => opt.value == value);

            this.data.startDate = selectedProject.startDate;
            this.data.address = selectedProject.address;
            this.data.city = selectedProject.city;
        },

        uploadAction(files) {
            files = files.map(file => file.name);
            this.data.projectImages = files;
        },

        async addFinishedProject () {
            if(this.isAddingNew)
                return await orderedProjectsService.createNewFinishedProject(this.data).data;
            else
                return await orderedProjectsService.finishProject(this.data.selected).data;
        }
    }
}
</script>
