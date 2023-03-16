<template>
    <main>
        <div class="container">
            <MainContainerItem v-if="blog" :blogs="blog" :user="user"/>
        </div>
    </main>
</template>

<script setup>
    import MainContainerItem from './BlogDetail.vue';
</script>

<script>
    import axios from 'axios';
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
                'id': this.$route.params.id,
                'user': null,
            }
        },
        
        methods: {
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
            },
        },

        mounted(){
            this.getCurrentUserData()
        }
    }
</script>