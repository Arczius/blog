<template>
    <div :style="'--tyler-image: url(' + tyler + ');'" class="tyler">

        <div v-for="item in count">
            <img @click="count++" :src="tyler" :style="'--item-width: ' + item + ';'" >
        </div>

    </div>
</template>

<style scoped>
    .tyler {
        background-image: var(--tyler-image);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 100vh;
        width: 100%;
        display: flex;
        max-width: 100%;
        flex-wrap: wrap;
    }

    .tyler div img {
        width: calc(var(--item-width) * 16px);
        height: calc(var(--item-width) * 16px);
        object-fit: cover;
        object-position: center;
    }
</style>

<script setup>
    import tyler from "../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<script>
    export default {
        name: "Tyler",
        data(){
            return {
                'count': 1,
            }
        }
    }
</script>
