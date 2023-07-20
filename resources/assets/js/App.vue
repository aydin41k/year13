<template>
    <div class="body">
      <heading></heading>
      <transition name="fade">
        <router-view></router-view>
      </transition>
      <footer-bar :name="dev"></footer-bar>
    </div>
</template>

<style>
    .body {
        --brand-color: #00328d;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>

<script>
    import Heading from './components/Heading.vue';
    import FooterBar from './components/FooterBar.vue';
    export default{
        components: {Heading, FooterBar},
        data() {
            return {
                dev: process.env.MIX_DEV
            }
        }
    }
</script>