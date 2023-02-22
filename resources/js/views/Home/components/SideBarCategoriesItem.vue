<template>
    <div>
        {{ category.name }}
    </div>
</template>

<script>
export default {
    name: "SideBarCategoriesItem",
    props: ['category']
}
</script>
