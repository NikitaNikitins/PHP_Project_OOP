<template>
    <div>
        <div>
            <b-form-file v-model="files" multiple @input="submitFiles"/>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            files: []
        }
    },

    methods: {
        submitFiles() {
            this.$emit('uploadAction', this.files);
        }
    }
}
</script>
