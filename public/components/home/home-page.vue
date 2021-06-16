<template>
    <div class="container">
        <services-info />
        <div class="block-divider"></div>
        <created-projects />
        <div class="block-divider"></div>
    </div>
</template>

<script>
import servicesInfo from './components/services-info';
import createdProjects from './components/created-projects';

export default {
    components: {
        servicesInfo,
        createdProjects
    }
}
</script>
