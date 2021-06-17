<template>
<div class="completed-projects-wrapper container-fluid">
    <h1>ER Diagramma</h1>
    <img :src="img" alt="ER DIagramma">
</div>
</template>

<script>
export default {
    data() {
        return {
            img: require('components/common/images/er-diagram.png'),
        }
    }
}
</script>

