<template>
    <main>
        <div class="container--tyler">
            <MainContainerItemSkeleton v-if="blogs === null"/>

            <MainContainerItem v-else v-for="blog in blogs" :blog="blog"/>
        </div>
        
    </main>
</template>

<script setup>
import MainContainerItemSkeleton from './MainContainerItemSkeleton.vue'
import MainContainerItem from './MainContainerItem.vue';
import axios from 'axios'
</script>


<script>
export default {
    name: "MainContainer",
    data(){
        return {
            'blogs': null,
        }
    },

    methods: {
        getAllBlogs(){
            axios.get('/api/blog')
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
        this.getAllBlogs()
    }
}
</script>