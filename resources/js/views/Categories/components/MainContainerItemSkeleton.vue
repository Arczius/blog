<template>
    <div v-for="item in 30" class="skeleton__item">
        <div class="skeleton__item--image"></div>
        <div class="skeleton__item--text"></div>
    </div>
</template>

<style scoped>
    .skeleton__item {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .skeleton__item--image {
        width: 100%;
        padding-bottom: 100%;
        border-radius: 100%;
        background-color: gray;
    }

    .skeleton__item--text {
        width: 65%;
        height: 1.3rem;
        border-radius: 0.5rem;
        background-color: gray;
    }
</style>

<script>
    export default {
        name: "MainContainerItemSkeleton"
    }
</script>
