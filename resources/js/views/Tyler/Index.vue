<template>
    <div :style="'--tyler-image: url(' + Tyler + ');'" class="tyler">

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
}
</style>

<script setup>
import Tyler from "../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg"
</script>

<script>
export default {
    name: "Tyler"
}
</script>
