<template>
    <div class="footer-bar">
        This assignment is completed by: {{ name }}
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
        padding: 3px 1rem;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>