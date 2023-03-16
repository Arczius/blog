<template>
    <mainContainerBanner v-if="users !== null" :users="users"/>

    <main class="profile__main">
        <mainContainerItem v-if="users !== null" :users="users"/>

        <div class="profile profile__categories">
            <sideBarCategories :users="users"/>
        </div>
    </main>
</template>

<script setup>
    import mainContainerItem from './Profile.vue';
    import mainContainerBanner from './ProfileBanner.vue';
    import sideBarCategories from '../../Home/components/SideBarCategories.vue';
    import axios from 'axios'
</script>

<script>
    export default {
        name: "MainContainer",
        data(){
            return {
                'users': null,
                'id': this.$route.params.id
            }
        },

        methods: {
            getUserProfile(){
                axios.get('/api/profile/user/' + this.id)
                    .then((response) => {
                        this.users = response.data.users
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            getUserProfileDetail(){
                axios.get('/api/profile/detail/user/' + this.id)
                    .then((response) => {
                        this.users = response.data.users
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },
        },

        mounted(){
            this.$route.path == "/detail/" + this.id ?  this.getUserProfileDetail() :    this.getUserProfile();
        },

        watch: {
	        $route () {
                this.$route.path == "/detail/" + this.id ?  this.getUserProfileDetail() :    this.getUserProfile();
                
                this.users = null;
                this.id = this.$route.params.id
	        }
        }
    }
</script>
