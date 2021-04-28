<template>
    <component :is="componentName" class="icon" :class="[iconClass, variant]"></component>
</template>

<script>
    import companyLogo from 'components/svg/main-logo.svg';
    import loginIcon from 'components/svg/login.svg';
    import registerIcon from 'components/svg/add-user.svg';
    import stonksIcon from 'components/svg/stonks.svg';
    import teamIcon from 'components/svg/team.svg';
    import clockIcon from 'components/svg/clock.svg';
    import groupIcon from 'components/svg/group.svg';
    import locationIcon from 'components/svg/placeholder.svg';

    const iconTypes = {
        'main-logo': { component: companyLogo, class: 'icon-main-logo' },
        'login-icon': { component: loginIcon, class: 'icon-main-logo' },
        'register-icon': { component: registerIcon, class: 'icon-main-logo' },
        'stonks-icon': { component: stonksIcon, class: 'icon-info' },
        'team-icon': { component: teamIcon, class: 'icon-info' },
        'clock-icon': { component: clockIcon, class: 'icon-project-info' },
        'group-icon': { component: groupIcon, class: 'icon-project-info' },
        'location-icon': { component: locationIcon, class: 'icon-project-info' }
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