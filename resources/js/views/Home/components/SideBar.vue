<template>
    <section class="home__sidebar--categories">
        <SideBarCategories :users="users"/>
    </section>

    <section class="home__sidebar--top-posts">
        <SideBarTopPosts/>
    </section>
</template>

<script setup>
import SideBarCategories from './SideBarCategories.vue';
import SideBarTopPosts from './SideBarTopPosts.vue';
</script>


<script>
export default {
    name: "SideBar",

    data(){
        return {
            'users': null,
        }
    },

    methods: {
        
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
        this.getUserProfile()
    }
}
</script>
