<template>
    <div class="currency-input">
        <input type="text" class="form-control" v-model="displayValue" @blur="isInputActive = false" @focus="isInputActive = true"/>
    </div>
</template>

<script>
export default {
    props: {
        value: Number
    },

    data() {
        return {
            isInputActive: false
        }
    },

    computed: {
        displayValue: {
            get: function() {
                if (this.isInputActive) {
                    return this.value.toString()
                } else {
                    return "€ " + this.value.toFixed(2).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,")
                }
            },
            set: function(modifiedValue) {
                let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ""))
                // Ensure that it is not NaN
                if (isNaN(newValue)) {
                    newValue = 0
                }
                this.$emit('input', newValue)
            }
        }
    }
}
</script>

