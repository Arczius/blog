<template>
    <BlogStore v-if="blog !== null" :blog="blog"/>
</template>

<script setup>
    import BlogStore from './components/BlogStore.vue';
</script>

<script>
    import axios from 'axios'
export default {
    name: "Edit blog",
    props: {
        
    },

    data(){
        return {
            'id': this.$route.params.id,
            'blog': null,
        }
    },
    
    methods: {
        getCurrentBlogInfo(){
            console.log(this.id);
            axios.post('/api/blog/info/' + this.id, {
            },
            )
            .then((response) =>  {  
                this.blog = response.data 
            })
            .catch(function (error) {  
                console.log(error);
            });
        }
    },
    mounted(){
        this.getCurrentBlogInfo()
    }
}
</script>
