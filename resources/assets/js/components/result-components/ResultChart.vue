<template>
    <div class="subsection-container">
        <div class="subheader">Visual comparison of skills that are most important for both occupations</div>
        <comparison-chart :occupation_data="occupation_data"></comparison-chart>
    </div>
</template>

<script>
    import ComparisonChart from "../assets/ComparisonChart.vue";
    import Subheader from "../assets/Subheader.vue";
    export default {
        components: {Subheader, ComparisonChart},
        props: {
            occupation_data: Object,
        },
    }
</script>