<template>
    <div v-if="this.$route.path == '/store'">
        <blogStore v-if="user !== null" :user="user"/>
    </div>
    <blogStore v-if="blog !== null" :blog="blog" :user="user"/>
</template>

<script setup>
    import blogStore from './components/BlogStore.vue';
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
            /* get the old data of the blog */
            getCurrentBlogInfo(){
                axios.post('/api/blog/info/' + this.id, {
                },
                )
                .then((response) =>  {
                    this.blog = response.data
                })
                .catch(function (error) {
                    console.warn(error);
                });
            },

            /* get the id and token of the current logged in user */
            getCurrentUserData(){
                axios.post('/api/user/currentUser', {
                    'userID': localStorage.getItem('userID'),
                    'token': localStorage.getItem('token'),
                })
                    .then((response) => {
                        this.user = response.data.user
                    })
                    .catch((error) => {
                        console.warn(error)

                    })
            }
        },
        mounted(){
            this.getCurrentUserData()
            if (this.$route.path !== '/store') {
                this.getCurrentBlogInfo()
            }
        }
    }
</script>
