<template>
    <div class="category__item">
        <img v-if="category.picture !== ''"  :src="category.picture" alt="" loading="lazy">
        <img v-else :src="DefaultImage" alt="" loading="lazy">
        <p>
            {{ category.name }}
        </p>
    </div>
</template>

<style scoped>
.category__item {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;

    gap: 10px;
}

.category__item img {
    width: 100%;
    aspect-ratio: 1/1;
    border-radius: 100%;
    object-fit: cover;
    object-position: center;
}

</style>


<script setup>
import DefaultImage from "../../../../assets/rolands-varsbergs-miKmVyq3qhE-unsplash.jpg"

</script>

<script>
export default {
    props: [
        'category'
    ]
}
</script>
