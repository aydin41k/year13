<template>
  <div class="heading">
    <Year13Logo></Year13Logo>
    <h1>Occompare</h1>
    <small>Compare two selected occupations in terms of Skills using ONET data</small>
    <hr/>
  </div>
</template>

<script>
    import Year13Logo from './assets/Year13Logo.vue';
    export default {
      name: 'heading',
      components: {Year13Logo},
    }
</script>

<style lang="scss" scoped>
    .heading {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
        small {
          color: #999;
        }
        h1 {
            font-size: 2.5em;
            margin: 0 auto;
        }
    }
</style>