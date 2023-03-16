<template>
    <div class="skeleton--item" v-for="category in 5">

    </div>
</template>

<style lang="scss" scoped>
    .skeleton{
        &--item {
            background-color: gray;
            height: 1.3rem;
            width: 33%;
            border-radius: 2rem;
        }
    }
</style>

<script>
    export default {
        name: "SideBarCategoriesItemSkeleton",
    }
</script>
