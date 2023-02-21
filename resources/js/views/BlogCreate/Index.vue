<template>
    <div class="create__holder">
        <BlogCreate/>
        <BlogDetail/>
    </div>
</template>

<script setup>
import BlogCreate from './components/BlogCreate.vue';
import BlogDetail from './components/BlogDetail.vue';
</script>

<script>
export default {
    name: "Index",
}
</script>
