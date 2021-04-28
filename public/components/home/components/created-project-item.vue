<template>
    <div class="created-project-info-block">
        <img :src="imgSrc" alt="">
        <div class="project-info row mt-3">
            <div class="col"><icon type="clock-icon"/> 3 months</div>
            <div class="col"><icon type="group-icon" /> 5 members</div>
            <div class="col"><icon type="location-icon" /> The Hague</div>
        </div>
        <div class="mt-3">
            <h4>Project titleasd</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia minus eveniet incidunt quidem aliquid perferendis hic aliquam? Corporis porro totam autem alias quas. Veniam vel assumenda esse odit! In, iure!</p>
        </div>
    </div>
</template>

<script>
export default{
    props: {
        imgSrc: ''
    },

    data() {
        return {
        }
    },

    mounted() {
    }
}

</script>
