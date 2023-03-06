<template>
    <main>
        <mainContainerBanner v-if="users !== null" :users="users"/>

        <div class="sidebar">
            <mainContainerItem v-if="users !== null" :users="users"/>
        </div>
    </main>
</template>

<script setup>
import mainContainerItem from './Profile.vue';
import mainContainerBanner from './ProfileBanner.vue';
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
