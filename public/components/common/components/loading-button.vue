<template>
    <div class="loading-btn">
        <vue-loading-button :loading="isLoading" :class="variant">
            {{text}}
        </vue-loading-button>
    </div>
</template>

<script>
    import VueLoadingButton from 'vue-loading-button'

    export default {
        props: {
            isLoading: Boolean,
            variant: String,
            text: String
        },
        components: {
            VueLoadingButton,
        },
    }
</script>

