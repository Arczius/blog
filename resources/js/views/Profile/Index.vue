<template>
    <div class="profile">
        <div class="profile profile__container">
            <mainContainer/>

            <div class="profile profile__info">
                <blogCreate/>
                <blog/>
            </div>
        </div>
    </div>
</template>

<script setup>
    import blogCreate from '../BlogCreate/components/BlogCreate.vue';
    import blog from '../ShowBlog/components/MainContainer.vue';
    import mainContainer from '../Profile/components/MainContainer.vue';
</script>

<script>
    import axios from 'axios'

    export default {
        name: "users",

        data(){
            return {
                'users': null,
                'id': this.$route.params.id
            }
        },

        methods: {
            /* get the personal profile of the user*/
            getUserProfile(){
                    axios.get('/api/profile/user/' + this.id)
                        .then((response) => {
                            this.users = response.data.users
                        })
                        .catch((error) => {
                            console.warn(error)
                        })
                },
        },

        mounted(){
            this.getUserProfile()
        },
    }
</script>

