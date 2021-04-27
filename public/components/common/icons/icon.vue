<template>
    <component :is="componentName" class="icon" :class="[iconClass, variant]"></component>
</template>

<script>
    import companyLogo from 'components/svg/main-logo.svg';

    const iconTypes = {
        'main-logo': { component: companyLogo, class: 'main-logo' },
    };

    const components = {};

    Object.keys(iconTypes).map(function (key, index) {

        components['icon-' + key] = iconTypes[key].component ? iconTypes[key].component : iconTypes[key];

    });

    export default {
        props: {
            type: {
                type: String,
                default: 'entree',
                validator: function (value) {
                    return iconTypes.hasOwnProperty(value);
                }
            },
            variant: {
                type: String
            }
        },

        components: components,

        computed: {
            componentName() {
                return 'icon-' + this.type;
            },
            iconClass() {
                return iconTypes[this.type].class;
            }
        }
    };
</script>