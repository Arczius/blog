<template>
    <BlogStore v-if="blog !== null" :blog="blog"/>
    <BlogStore v-if="user !== null" :user="user"/>

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
              'user': null,
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
        },
        
          getCurrentUserData(){
                axios.post('/api/user/currentUser', {
                    'userID': localStorage.getItem('userID'),
                    'token': localStorage.getItem('token'),
                })
                    .then((response) => {
                        this.user = response.data.user
                        console.log(this.user)
                    })
                    .catch((error) => {
                        console.warn(error)
                    
                    })
            }
    },
    mounted(){
        this.getCurrentBlogInfo()
        this.getCurrentUserData()
    }
}
</script>
