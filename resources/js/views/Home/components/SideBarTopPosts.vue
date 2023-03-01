<template>
    <div>
        <h3>Top posts</h3>
        <div>
            <SideBarTopPostsItemSkeleton v-if="!posts || !users"/>
            <SideBarTopPostsItem v-else v-for="(item, index) in posts" :user="users[index]" :post="item"/>
        </div>
    </div>

</template>

<script setup>
import SideBarTopPostsItemSkeleton from './SideBarTopPostsItemSkeleton.vue'
import SideBarTopPostsItem from './SideBarTopPostsItem.vue'
</script>

<script>
import axios from 'axios';

export default {
    name: "SideBarTopPosts",
    data(){
        return {
            'posts': null,
            'users': null,
        }
    },
    methods: {
        getTopPosts(){
            axios.get("/api/post/top/6")
                .then((response) => {
                    this.posts = response.data.posts
                    this.users = response.data.users
                })
        }
    },
    mounted() {
        this.getTopPosts()
    }
}
</script>
