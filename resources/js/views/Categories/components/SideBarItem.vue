<template>
    <div>
        {{ category.name }}
    </div>
</template>

<script>
export default {
    name: "SideBarItem",
    props: [
        'category'
    ]
}
</script>
