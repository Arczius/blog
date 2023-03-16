<template>
    <!-- 
        needs 2 templates because the detail page needs an extra div so there is no warning in the console,
        if this div is added to the profile page the styling gets destroyed  
    -->

    <!-- if the current page is the personal profile show this template -->
    <template v-if="this.$route.path === '/profile/user/' + this.$route.params.id">
        <mainContainerBanner v-if="users !== null" :users="users"/>

        <main class="profile__main">
            <mainContainerItem v-if="users !== null" :users="users"/>

            <div class="profile profile__categories">
                <sideBarCategories v-if="users" :users="users"/>
            </div>
        </main>
    </template>

    <!-- if the current page is the detail page show this template -->
    <template v-else>
        <div>
            <mainContainerBanner v-if="users !== null" :users="users"/>
            
            <main class="profile__main">
                <mainContainerItem v-if="users !== null" :users="users"/>
        
                <div class="profile profile__categories">
                    <sideBarCategories v-if="users" :users="users"/>
                </div>
            </main>
        </div>
    </template>
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
            this.$route.path == "/detail/" + this.id 
                ? this.getUserProfileDetail() 
                    : this.getUserProfile();
        },

        watch: {
	        $route () {
                this.users = null;
                this.id = this.$route.params.id

                this.$route.path == "/detail/" + this.id 
                    ? this.getUserProfileDetail() 
                        : this.getUserProfile();
	        }
        }
    }
</script>
