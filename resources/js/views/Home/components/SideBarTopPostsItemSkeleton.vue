<template>
    <div v-for="skeleton in 4" class="skeleton__item">
        <div class="skeleton__item--left">
            <div></div>
        </div>
        <div class="skeleton__item--right">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .skeleton__item {
        display: flex;
        width: 100%;
        gap: 10px;
        padding-bottom: 10px;
    }

    .skeleton__item--left{
        width: 20%;
        height: 100%;
    }

    .skeleton__item--left div {
        height: 50px;
        width: 50px;
        border-radius: 100%;
        background-color: gray;
    }

    .skeleton__item--right{
        flex-grow: 1;
        display: grid;
        gap: 5px;
    }

    .skeleton__item--right div {
        background-color: gray;
        border-radius: 0.4rem;

        &:nth-of-type(1){
            width: 60%;
            height: 1rem;
        }

        &:nth-of-type(2){
            height: 1.3rem;
            width: 100%;
        }

        &:nth-of-type(3){
            height: 4rem;
            width: 80%;
        }
    }
</style>

<script>
    export default {
        name: "SideBarTopPostsItemSkeleton",

    }
</script>
