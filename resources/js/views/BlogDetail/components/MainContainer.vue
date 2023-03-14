<template>
    <main>
        <div class="container">
            <MainContainerItem v-if="blog" :blogs="blog"/>
        </div>
    </main>
</template>

<script setup>
import MainContainerItem from './BlogDetail.vue';
</script>

<script>
export default {
    name: "MainContainer",
    props: {
        blog: {
            default: null,
            type: Object
        }
    },
    data(){
        return {
            'id': this.$route.params.id
        }
    },
}
</script>
