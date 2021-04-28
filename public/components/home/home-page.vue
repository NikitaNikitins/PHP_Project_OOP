<template>
    <div>
        <services-info />
        <div class="block-divider container"></div>
        <created-projects />
        <div class="block-divider container"></div>
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
