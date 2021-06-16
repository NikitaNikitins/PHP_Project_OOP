<template>
    <div class="created-projects-info d-flex flex-column justify-content-center">
        <span class="badge-info">Created Projects</span>
        <div class="info-container align-self-center mt-5">
            <div class="text-center">
                <h2 class="font-weight-bold">
                    Created Projects by our team
                </h2>
                <router-link to="/completedProjects" class="nav-link mt-2 animated-underline">See our other created projects ></router-link>
            </div>
        </div>
        <div class="row justify-content-between mt-5">
            <div class="col"  v-for="project in projects" :key="project.City">
                <created-project-item :data="project" :isEditable="false"/>
            </div>
        </div>
    </div>
</template>

<script>
    import createdProjectItem from '../../common/components/created-project-item';

    export default {
        data() {
            return {
                projects: [
                    {
                        MainImage: require('components/common/images/project-1.png'),
                        ProjectTitle: "Example title",
                        TimeSpent: 9,
                        EmployedCount: 4,
                        City: 'The Hague',
                        ProjectDescription: 'Simple Dimple'
                    },
                    {
                        MainImage: require('components/common/images/project-2.png'),
                        Title: "Example title",
                        TimeSpent: 9,
                        EmployedCount: 4,
                        City: 'Rotterdam',
                        Text: 'Simple Dimple'
                    }
                ]
            }
        },

        components: {
            createdProjectItem,
        }
    }
</script>
