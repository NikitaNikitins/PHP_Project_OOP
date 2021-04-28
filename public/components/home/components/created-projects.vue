<template>
    <div class="created-projects-info d-flex flex-column justify-content-center">
        <span class="badge-info">Created Projects</span>
        <div class="info-container align-self-center mt-5">
            <div class="text-center">
                <h2 class="font-weight-bold">
                    Created Projects by our team
                </h2>
                <a class="mt-2 animated-underline">
                    See our other created projects >
                </a>
            </div>
        </div>
        <div class="row justify-content-between mt-5">
            <div class="col-5">
                <created-project-item :imgSrc="'./components/common/images/project1.png'"/>
            </div>
            <div class="col-5">
                <created-project-item :imgSrc="'./components/common/images/project2.png'"/>
            </div>
        </div>
    </div>
</template>

<script>
    import createdProjectItem from './created-project-item';

    export default {
        components: {
            createdProjectItem
        }
    }
</script>
