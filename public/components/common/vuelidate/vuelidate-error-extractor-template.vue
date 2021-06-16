<template>
    <div class="form-group" :class="['', {'is-invalid': hasErrors, 'is-valid': !hasErrors && validator.$dirty}]">
        <slot name="label">
            <label v-if="label && !hideLabel" :for="labelForInputId" :class="{required: labelRequired}">{{ label }}</label>
        </slot>
        <slot :errors="activeErrors"
              :has-errors="hasErrors"
              :first-error-message="firstErrorMessage">
        </slot>
        <slot name="errors"
              :errors="activeErrors"
              :has-errors="hasErrors"
              :first-error-message="firstErrorMessage">
            <template v-if="hasErrors">
                <div class="invalid-feedback" v-if="showSingleError"
                     :data-validation-attr="firstError.validationKey">
                    {{ firstErrorMessage }}
                </div>
                <template v-if="!showSingleError">
                    <div class="invalid-feedback" v-for="error in activeErrors"
                         :key="error.validationKey"
                         :data-validation-attr="error.validationKey">
                        {{ getErrorMessage(error.validationKey, error.params) }}
                    </div>
                </template>
            </template>
        </slot>
    </div>
</template>
<script>
    import messageExtractorMixin from 'vuelidate-error-extractor/dist/message-extractor-mixin'

    export default {
        mixins: [messageExtractorMixin],

        props: {
            labelFor: {
                type: String,
                default: null
            },

            hideLabel: {
                type: Boolean,
                default: false
            },

            labelRequired: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                labelForInputId: null
            };
        },

        beforeUpdate() {
            this.$nextTick(() => {
                this.labelForInputId = this.getLabelFor();
            });
        },

        watch: {
            labelFor() {
                this.labelForInputId = this.getLabelFor();
            }
        },

        created() {
            this.$nextTick(() => {
                this.$children.forEach(element => {
                    if (!Array.isArray(this.validator.$params)) {
                        element.$el.onblur = this.touch;
                        element.$el.oninput = this.unTouch;
                    }
                });
            });
        },

        methods: {
            getLabelFor() {
                if (this.labelFor)
                    return this.labelFor;

                let childFormComponents = this.$children.filter(child => {
                    return (child.$el.localName === "input" || child.$el.localName === "select") && child.$el.id;
                });

                if (childFormComponents.length > 0)
                    return childFormComponents[0].$el.id;

                let multiselect = this.$children.filter(child => {
                    return child.$el.localName === "div" && (child.$el.className).includes('multiselect');
                });

                if (multiselect.length > 0) {
                    var multiselectInput = multiselect[0].$el.firstChild.nextElementSibling.firstChild.nextElementSibling.nextElementSibling;

                    if (multiselectInput.id)
                        return multiselectInput.id;

                    let idForMultiselect = this._uid + "__multiselect_input";
                    multiselectInput.id = idForMultiselect;

                    return idForMultiselect;

                }

                return "";
            },

            touch() {
                if (this.validator.$invalid) {
                    this.validator.$touch();
                }
            },

            unTouch() {
                if (!this.validator.$invalid) {
                    this.validator.$reset();
                }
            },
        }
    }
</script>
