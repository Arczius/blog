<template>
    <div v-for="item in 1" class="skeleton__item">
        <div class="skeleton__item--image"></div>
        <div class="skeleton__item--text"></div>
    </div>
</template>

<script>
    export default {
        name: "MainContainerItemSkeleton"
    }
</script>
