<template>
    <div class="result-footer">
        <p class="title">
            If you would like to get more information about these occupations, please follow the links below to navigate to the O*NET website.
        </p>
        <p class="link">
            <a v-bind:href="'https://www.onetonline.org/link/details/' + occupation_data.occupation_1.code" target="_blank">
                {{ occupation_data.occupation_1.code }} {{ occupation_data.occupation_1.name }}
            </a>
        </p>
        <p class="link">
            <a v-bind:href="'https://www.onetonline.org/link/details/' + occupation_data.occupation_2.code" target="_blank">
                {{ occupation_data.occupation_2.code }} {{ occupation_data.occupation_2.name }}
            </a>
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            occupation_data: Object,
        },
    }
</script>

<style scoped>
    .result-footer {
        margin-bottom: 70px;
        border: 2px dashed #ccc;
        padding: 4px 10px;
        border-radius: 0.5rem;

        .title {
            font-size: 1.1rem;
        }

        .link {
            font-size: 1.2rem;
        }
    }
</style>