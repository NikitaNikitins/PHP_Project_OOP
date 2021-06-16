export default {
    data() {
        return {
            errors: [],
            isSubmitted: false
        }
    },

    methods : {
        async submit() {
            this.errors = [];

            if (this.$v && !this.isInputValid(this))
                return;

            try {
                await this.onSubmit();
            }
            catch (error) {
                this.errors = error.customErrors;
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

        async onSubmit() { }
    }
}
