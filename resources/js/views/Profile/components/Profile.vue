<template>
    <div class="profile">
        <div class="profile__picture">
            <img class="profile__picture profile__picture--image" :src="(users.profile_picture !== '') ? '../../storage/ProfilePictures/' + users.profile_picture : defaultProfilePicture" alt="profileImage" loading="lazy">
        </div>

        <div class="profile__user">
            <h3 class="profile__user profile__user--name">{{users.username}}</h3>
            <h4 class="profile__user profile__user--username">@{{users.handle}}</h4>
            <p class="profile__user profile__user--description">{{users.about_me}}</p>

            <button @click="followers.ShowUsers = !followers.ShowUsers" class="profile__user profile__user--button profile__user--button-followers">{{followers.Amount}} volgers</button>
            <FollowingList :Users="followers.Users" Title="Volgers:" v-if="followers.ShowUsers"/>

            <button @click="following.ShowUsers = !following.ShowUsers" class="profile__user profile__user--button profile__user--button-following">{{following.Amount}} volgend</button>
            <FollowingList :Users="following.Users" Title="Volgend:" v-if="following.ShowUsers"/>
            

            <button @click="doFollow()" v-if="followers.UserFollows !== null" class="profile__user profile__user--button">{{ (followers.UserFollows) ? 'unfollow' : 'follow'}}</button>
        </div>
    </div>
</template>

<script setup>
    import defaultProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import axios from 'axios'
    import FollowingList from './FollowingList.vue'
</script>

<script>
    export default {
        name: "Profile",
        props: [
            "users",
        ],

        data(){
            return {
                // 'followerAmount': 0,
                followers: {
                    Amount: 0,
                    Users: null,
                    ShowUsers: false,
                    UserFollows: null,
                },

                following: {
                    Amount: 0,
                    Users: null,
                    ShowUsers: false,

                }
            }
        },

        methods: {
            getFollowers(){
                axios.get("/api/follow/followers/single/" + this.users.id)
                    .then((response) => {
                        this.followers.Amount = response.data.follower_amount
                        this.followers.Users = response.data.followers
                    })
            },

            getFollowing(){
                axios.get("/api/follow/following/single/" + this.users.id)
                    .then((response) => {
                        this.following.Amount = response.data.following_amount
                        this.following.Users = response.data.following
                    })
            },

            checkFollow(){
                if(this.$route.params.id !== localStorage.getItem('userID'))
                {
                    axios.post('/api/follow/check', {
                        'current_user_id': localStorage.getItem('userID'),
                        'follow_user_id': this.$route.params.id
                    })
                        .then(response => {
                            this.followers.UserFollows = response.data.following
                        })
                }
            },

            doFollow(){
                const item = this.followers.UserFollows
                this.followers.UserFollows = null

                axios.post('/api/follow', {
                    'token': localStorage.getItem('token'),
                    'userid': localStorage.getItem('userID'),
                    'follow_user_id': this.users.id,
                    'action': (item) ? 'unfollow' : 'follow'
                })
                    .then(response => {
                        this.followers.UserFollows = response.data.following
                        this.followers.Amount = (this.followers.UserFollows) ? this.followers.Amount + 1  : this.followers.Amount - 1
                    })
            }
        },

        mounted(){
            this.getFollowers()
            this.getFollowing()
            this.checkFollow()
        },
    }
</script>
