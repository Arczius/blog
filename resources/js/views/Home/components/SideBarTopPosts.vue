<template>
    <div>
        <h3>Top posts</h3>
        <div>
            <SideBarTopPostsItemSkeleton v-if="!posts"/>
            <SideBarTopPostsItem v-else v-for="item in posts" :user="item.user" :post="item"/>
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
        }
    },
    methods: {
        getTopPosts(){
            axios.get("/api/post/top/6")
                .then((response) => {
                    this.posts = response.data.posts
                })
        }
    },
    mounted() {
        this.getTopPosts()
    }
}
</script>
