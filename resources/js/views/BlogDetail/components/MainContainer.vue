<template>
    <main>
        <div class="container">
            <MainContainerItem v-if="blog" :blogs="blog"/>
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
    props: {
        blog: {
            default: null,
            type: Object
        }
    },
    data(){
        return {
            // 'blogs': null,
            'id': this.$route.params.id
        }
    },

    methods: {
        // getBlogDetail(){
        //     axios.get('/api/blog/detail/' + this.id)
        //         .then((response) => {
        //             this.blogs = response.data.blogs
        //             console.log(this.blogs)
        //         })
        //         .catch((error) => {
        //             console.warn(error)
        //         })
        // },
    },

    mounted(){
        // this.getBlogDetail()
    }
}
</script>
