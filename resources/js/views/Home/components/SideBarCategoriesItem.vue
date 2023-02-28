<template>
    <div class="categories__item">
        {{ category.name }}
    </div>
</template>

<script>
export default {
    name: "SideBarCategoriesItem",
    props: ['category']
}
</script>
