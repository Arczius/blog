<template>
    <div class="profile">
        <div v-if="this.$route.path == '/profile/user/' + path_name">
            <div class="profile__picture">
                <img class="profile__picture profile__picture--image" :src="(users.profile_picture !== '') ? '../../storage/ProfilePictures/' + users.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
            </div>
    
            <div class="profile__user">
                <h3 class="profile__user profile__user--name">{{users.username}}</h3>
                <h4 class="profile__user profile__user--username">@{{users.handle}}</h4>
                <p class="profile__user profile__user--description">{{users.about_me}}</p>
    
                <button class="profile__user profile__user--button profile__user--button-followers">{{followerAmount}} volgers</button>
                <button class="profile__user profile__user--button profile__user--button-following">{{followingAmount}} volgend</button>
            </div>
        </div>

        <div v-else>
            <div class="profile__picture">
                <img class="profile__picture profile__picture--image" :src="(users[0].user.profile_picture !== '') ? '../../storage/ProfilePictures/' + users[0].user.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
            </div>
    
            <div class="profile__user">
                <h3 class="profile__user profile__user--name">{{users[0].user.username}}</h3>    
                <h4 class="profile__user profile__user--username">@{{users[0].user.handle}}</h4>
                
                <p class="profile__user profile__user--description">{{users[0].user.about_me}}</p>
    
                <button class="profile__user profile__user--button profile__user--button-followers">{{followerAmount}} volgers</button>
                <button class="profile__user profile__user--button profile__user--button-following">{{followingAmount}} volgend</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import defaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import axios from 'axios'
</script>

<script>
    export default {
        name: "Profile",
        props: [
            "users",
        ],

        data(){
            return {
                'followerAmount': 0,
                'followingAmount': 0,
                'path_name': this.$route.params.id
            }
        },

        methods: {
            getFollowers(){
                var param = null;

                this.$route.path == '/profile/user/' + this.$route.params.id 
                    ? param = this.users.id 
                        : param = this.users[0].user.id;
                

                axios.get("/api/follow/followers/single/" + param)
                    .then((response) => {
                        this.followerAmount = response.data.follower_amount
                    })
            },

            getFollowing(){
                var param = null;

                this.$route.path == '/profile/user/' + this.$route.params.id 
                    ? param = this.users.id 
                        : param = this.users[0].user.id;

                axios.get("/api/follow/following/single/" + param)
                    .then((response) => {
                        this.followingAmount = response.data.following_amount
                    })
            }
        },

        mounted(){
            this.getFollowers()
            this.getFollowing()
        },
    }
</script>
