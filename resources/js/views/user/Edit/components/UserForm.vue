<template>
    <div>

        <div>
            <h3>Username:</h3>
            <input type="text" v-model="userData.username">
        </div>

        <div>
            <h3>Email:</h3>
            <input type="email" v-model="userData.email">
        </div>

        <div>
            <h3>About me:</h3>
            <textarea v-model="userData.about_me"></textarea>
        </div>

        <div>
            <h3>Profile picture:</h3>
            <img v-if="user.profile_picture !== null || user.profile_picture !== ''" :src="user.profile_picture" alt="">
            <input v-on:change="updateLocalProfilePicture()" ref="ProfilePicture" type="file">
        </div>

        <div>
            <h3>Profile header:</h3>
            <img v-if="user.profile_header !== null || user.profile_header !== ''" :src="user.profile_header" alt="">
            <input v-on:change="updateLocalProfileHeader()" ref="ProfileHeader" type="file">
        </div>

        <div>
            <button @click="submitForm()">
                update gegevens
            </button>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "UserForm",
    props: {
        'user': {
            default: null
        }
    },

    data() {
        return {
            'profile_picture': null,
            'profile_header': null,

            'token': localStorage.getItem('token'),
            'userID': localStorage.getItem('userID'),

            'userData': {
                'username': null,
                'email': null,
                'about_me': null,
            }
        }
    },

    methods: {
        submitForm(){
            console.log("submit")
            axios.post("/api/user/update", {
                'username': this.userData.username,
                'email': this.userData.email,
                'about_me': this.userData.about_me,
                'token': this.token,
                'userID': this.userID,
            })
                .then((response) => {
                    console.log(response)

                    if(this.profile_picture === null && this.profile_header === null){
                        this.$router.push("/home")
                    }

                    if(this.profile_picture !== null) {
                        this.sendLocalProfilePicture()
                    }

                    if(this.profile_header !== null) {
                        this.sendLocalProfileHeader()
                    }

                })
                .then(() => {
                })
        },
        sendLocalProfilePicture(){
            axios.post("/api/user/update/profile_picture",
                {
                    'image': this.profile_picture,
                    'token': this.token,
                    'userID': this.userID,
                },
                {
                    headers: {
                        "Content-Type": 'multipart/form-data'
                    }
                }
            )
                .then((response) => {

                })
        },
        sendLocalProfileHeader(){
            axios.post("/api/user/update/profile_header",
                {
                    'image': this.profile_header,
                    'token': this.token,
                    'userID': this.userID,
                },
                {
                    headers: {
                        "Content-Type": 'multipart/form-data'
                    }
                }
            )
                .then((response) => {

                })
        },
        updateLocalProfilePicture(){
            this.profile_picture = this.$refs.ProfilePicture.files[0]
        },
        updateLocalProfileHeader(){
            this.profile_header = this.$refs.ProfileHeader.files[0]
        },
    },

    mounted(){
        if(this.user !== null){
            this.userData.username = this.user.username
            this.userData.email = this.user.email
            this.userData.about_me = this.user.about_me
        }
    }
}
</script>

