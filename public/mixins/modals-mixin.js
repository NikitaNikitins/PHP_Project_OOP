export default {
    data() {
        return {
            closeModalOnSubmit: true,
            wasSubmitted: false,
            successPayload: null,
            errors: []
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
            if (this.$v && this.$v.$invalid) {
                let validatation = this.$v.data;

                for (let key in validatation) {
                    if (validatation[key].$invalid)
                        validatation[key].$touch();
                }

               // return;
            }

            await this.onSubmit();

            if (this.$v && !this.isInputValid(this))
                return;

            this.wasSubmitted = true;

            if (this.closeModalOnSubmit) {
                this.$refs.modal.hide();
            }
        },

        isInputValid(inputRef) {
            if (this.$v && this.$v.$invalid) {
                let validatation = this.$v;
                if (this.$v && this.$v.data)
                    validatation = this.$v.data

                for (let key in validatation) {
                    if (validatation[key].$invalid)
                        validatation[key].$touch();
                }

                return false;
            }

            return true;
        },

        modalHidden() {
            if (this.wasSubmitted)
                this.$emit('success', this.successPayload);
        },

         async beforeShow(params) {},
     }
}
