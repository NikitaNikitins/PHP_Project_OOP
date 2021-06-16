<template>
    <div class="completed-projects-card">
        <img class="card-img" :src="data.MainImage" alt="">
        <div class="card-content">
            <div class="project-info ">
                <span><icon type="clock-icon"/> {{data.TimeSpent}} months</span>
                <span><icon type="group-icon" /> {{data.EmployedCount}} members</span>
                <span><icon type="location-icon" /> {{data.City}}</span>
            </div>
            <h4>{{data.Title}}, {{data.City}}</h4>
            <p>{{data.Text}}</p>
        </div>
        <footer>
            <b-btn variant="outline-primary">More details</b-btn>
        </footer>
    </div>
</template>

<script>
export default{
    props: {
        data: null
    },

    data() {
        return {
        }
    }
}

</script>
