<template>
    <main class="edit-user">
        <userForm v-if="user" :user="user"/>
    </main>

</template>

<script setup>
    import userForm from "./components/UserForm.vue";
</script>

<script>
    import axios from 'axios'
    export default {
        name: "Edit user",
        data(){
            return {
                'user': null,
            }
        },
        methods: {
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
            if(localStorage.getItem('userID') !== null && localStorage.getItem('token') !== null){
                this.getCurrentUserData()
            }

            else {
                this.$router.push("/")
            }
        }
    }
</script>
