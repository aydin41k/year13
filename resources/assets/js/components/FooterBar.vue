<template>
    <div class="footer-bar">
        © 2023 This assignment is completed as a recruitment task for Year13.
        <br/>
        Author: {{ name }}
    </div>
</template>

<script>
    export default {
        name: 'footer-bar',
        props: {
            name: {
                default: '{ YOUR_NAME }'
            }
        }
    }
</script>

<style lang="scss" scoped>
    .footer-bar {
        background-color: var(--brand-color);
        text-align: center;
        color: #fff;
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>