<template>
    <main>
        <div class="container">
            <MainContainerItem v-if="blogs !== null" :blogs="blogs"/>
        </div>
    </main>
</template>

<script setup>
import MainContainerItem from './BlogDetail.vue';
import axios from 'axios'
</script>

<script>
export default {
    name: "MainContainer",
    data(){
        return {
            'blogs': null,
            'id': this.$route.params.id
        }
    },

    methods: {
        getBlogDetail(){
            axios.get('/api/blog/detail/' + this.id)
                .then((response) => {
                    this.blogs = response.data.blogs
                    console.log(this.blogs)
                })
                .catch((error) => {
                    console.warn(error)
                })
        },
    },

    mounted(){
        this.getBlogDetail()
    }
}
</script>
