<template>
    <div class="result-container py-4">
        <ResultChart :occupation_data="occupation_data"></ResultChart>
        <ResultTable :occupation_data="occupation_data"></ResultTable>
        <ResultFooter :occupation_data="occupation_data"></ResultFooter>
    </div>
</template>

<script>
    import ResultChart from "./ResultChart.vue";
    import ResultTable from "./ResultTable.vue";
    import ResultFooter from "./ResultFooter.vue";

    export default {
      props: {
        occupation_data: Object,
        match: Number,
      },
      components: { ResultChart, ResultTable, ResultFooter },
    }
</script>

<style>
    .subheader {
      font-size: 26px;
      line-height: 1.25;
      color: #00328d;
      margin: 2em auto 1.5em;
      width: 100%;
      text-align: center;
      font-weight: bold;
    }
    @media screen and (min-width: 768px) {
      .subsection-container {
        margin: 5em auto;
      }
    }
</style>