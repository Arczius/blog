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
        'blog': null,
    },

    data(){
        return {
            'id': this.$route.params.id
        }
    },
    
    methods: {
        getCurrentBlogInfo(){
            console.log(this.id);
            axios.post('/api/blog/info/' + this.id, {
            },
            )
            .then((response) =>  {  
                this.id = response.data.id 
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
