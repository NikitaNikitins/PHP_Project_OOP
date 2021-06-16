export default {
    data() {
        return {
            closeModalOnSubmit: true,
            wasSubmitted: false,
            successPayload: null
        }
    },

     methods: {
         async show(params) {
            await this.beforeShow(params);

            this.$refs.modal.show();
         },

         cancel() {
            this.$refs.modal.hide();
        },

         async submit() {
            await this.onSubmit();

                this.wasSubmitted = true;

                if (this.closeModalOnSubmit) {
                    this.$refs.modal.hide();
                }
        },

        modalHidden() {
            if (this.wasSubmitted)
                this.$emit('success', this.successPayload);
        },

         async beforeShow(params) {},
     }
}