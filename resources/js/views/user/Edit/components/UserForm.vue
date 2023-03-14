<template>
    <div class="edit-user__holder">

        <div class="edit-user__item edit-user__item--username">
            <h3>Username:</h3>
            <input type="text" v-model="userData.username">
        </div>

        <div class="edit-user__item edit-user__item--email">
            <h3>Email:</h3>
            <input type="email" v-model="userData.email">
        </div>

        <div class="edit-user__item edit-user__item--about_me">
            <h3>About me:</h3>
            <textarea v-model="userData.about_me" max="255"></textarea>
        </div>

        <div class="edit-user__item edit-user__item--profile-picture">
            <h3>Profile picture:</h3>
            <div class="edit-user__item--profile-picture-item">
                <img v-if="user.profile_picture !== null || user.profile_picture !== ''" :src="'/storage/ProfilePictures/' + user.profile_picture" alt="">

                <div v-if="local_profile_picture" class="new">
                    <div>
                        >
                    </div>
                    <div>
                        <img :src="local_profile_picture" alt="">
                    </div>
                </div>

                <input :accept="image_accepts" v-on:change="updateLocalProfilePicture()" ref="ProfilePicture" type="file">

            </div>
        </div>

        <div class="edit-user__item edit-user__item--profile-header">
            <h3>Profile header:</h3>
            <img v-if="user.profile_header !== null || user.profile_header !== ''" :src="'/storage/ProfileBanners/' + user.profile_header" alt="">

            <div v-if="local_profile_header" class="new">
                <div>
                    >
                </div>
                <div>
                    <img :src="local_profile_header" alt="">
                </div>
            </div>

            <input :accept="image_accepts" v-on:change="updateLocalProfileHeader()" ref="ProfileHeader" type="file">
        </div>

        <div class="edit-user__item edit-user__item--submit">
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

            'local_profile_picture': null,
            'local_profile_header': null,

            'image_accepts': 'image/png, image/jpg, image/webp, image/svg, image/gif',

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

                    if(!this.profile_picture && !this.profile_header){
                        this.$router.push("/home")
                    }

                    if(this.profile_picture) {
                        this.sendLocalProfilePicture()
                    }

                    if(this.profile_header) {
                        this.sendLocalProfileHeader()
                    }

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
                    if(!this.profile_header) {
                        this.$router.push('/home')
                    }
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
                    this.$router.push('/home')
                })
        },
        updateLocalProfilePicture(){
            this.profile_picture = this.$refs.ProfilePicture.files[0]
            this.local_profile_picture = URL.createObjectURL(this.profile_picture)
        },
        updateLocalProfileHeader(){
            this.profile_header = this.$refs.ProfileHeader.files[0]
            this.local_profile_header = URL.createObjectURL(this.profile_header)
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

