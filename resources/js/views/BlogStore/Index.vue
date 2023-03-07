<template>
    <BlogStore v-if="user !== null" :user="user"/>
</template>

<script setup>
    import BlogStore from './components/BlogStore.vue';
</script>

<script>
    import axios from 'axios';
    export default {
        name: "Index",
        data() {
            return {
                'user': null,
            };
        },

        methods: {
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
            this.getCurrentUserData()
        }
    }
</script>
