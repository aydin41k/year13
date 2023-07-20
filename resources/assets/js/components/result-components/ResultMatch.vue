<template>
  <div class="result-caption">
    Similarity is <span class="similarity-percent">{{ match }}%</span>
  </div>
</template>

<script>
  export default {
    props: {
      match: Number,
    },
  }
</script>

<style scoped>
  .result-caption {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2em;
    background: no-repeat 50%/ auto url('https://year13.com.au/images/y13x/home-gradient.png');
    border-radius: 0.5em;
    color: #ffffff
  }
  .similarity-percent {
    font-weight: bold;
    padding: 0.2em 0.5em;
    border-radius: 0.5em;
  }
</style>