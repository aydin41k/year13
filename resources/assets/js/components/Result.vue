<template>
    <div class="result-container py-4">
        <div class="result-caption">
            Similarity is <span class="similarity-percent">{{ match }}%</span>
        </div>
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

<style lang="scss" scoped>
.result-container {
  .result-caption {
    font-size: 2em;
  }
  .similarity-percent {
    background-color: #6a67ff;
    color: #ffffff;
    padding: 0.2em 0.5em;
    border-radius: 0.5em;
  }
}
</style>