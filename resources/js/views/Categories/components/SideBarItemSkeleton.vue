<template>
    <div v-for="item in 6" class="side-bar__skeleton--item">

    </div>
</template>

<style scoped>
.side-bar__skeleton--item {
    background: gray;
    height: 1.3rem;
    border-radius: 0.4rem;
    /* width: 34%; */
}

.side-bar__skeleton--item:nth-of-type(6n - 1) {
    width: 34%;
}

.side-bar__skeleton--item:nth-of-type(6n - 2) {
    width: 61%;
}

.side-bar__skeleton--item:nth-of-type(6n - 3) {
    width: 40%;
}

.side-bar__skeleton--item:nth-of-type(6n - 4) {
    width: 23%;
}

.side-bar__skeleton--item:nth-of-type(6n - 5) {
    width: 44%;
}

.side-bar__skeleton--item:nth-of-type(6n) {
    width: 34%;
}
</style>

<script>
export default {
    name: "SideBarItemSkeleton"
}
</script>
