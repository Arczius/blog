<template>
    <main>
        <div class="container">
            <mainContainerItemSkeleton v-if="blogs === null"/>

            <mainContainerItem  v-else v-for="blog in blogs" :blog="blog"/>
            <!-- <mainContainerItem  v-else v-for="user in users" :user="user"/> -->
        </div>
    </main>
</template>

<script setup>
    import mainContainerItemSkeleton from './MainContainerItemSkeleton.vue'
    import mainContainerItem from './MainContainerItem.vue';
    import axios from 'axios'
</script>

<script>
    export default {
        name: "MainContainer",
        props: {
            'blogs': null,
            'users': null,
        },
        data(){
            return {
                'id': this.$route.params.id    
            }
        },

        methods: {
            getAllBlogs(){
                console.log(this.blogs);
                axios.get('/api/blog')
                    .then((response) => {
                        this.blogs = response.data.blogs
                        console.log(this.blogs)
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            getUserProfile(){
                axios.get('/api/profile/user/' + this.id)
                    .then((response) => {
                        this.users = response.data.users
                        console.log(this.users)
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },
        },

        mounted(){
            this.getAllBlogs(),
            this.getUserProfile()
        }
    }
</script>

<!-- Attempting to mutate prop "users". Props are readonly.  -->
<!-- 'set' on proxy: trap returned falsish for property 'users' -->