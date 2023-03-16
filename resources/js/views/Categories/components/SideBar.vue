<template>
    <aside>
        <h5>Top categorieen</h5>
        <div class="side-bar__holder">
            <sideBarItemSkeleton v-if="!topCategories"/>
            <sideBarItem v-else v-for="category in topCategories" :category="category"/>
        </div>
    </aside>
</template>

<style>
    aside {
        height: 100%;
        min-width: 20%;
        background-color: white;
        padding: 0.8rem;
        display: grid;
        gap: 1rem;
    }

    .side-bar__holder {
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
    }
</style>

<script setup>
    import sideBarItemSkeleton from './SideBarItemSkeleton.vue'
    import sideBarItem from './SideBarItem.vue'
</script>


<script>
import axios from 'axios';

export default {
    name: "SideBar",
    data(){
        return {
            'topCategories': null,
        }
    },
    methods: {
        getTopCategories(){
            axios.get("/api/category/top")
                .then((response) => {
                    this.topCategories = response.data.top_categories
                })
                .catch((error) => {
                    console.warn(error)
                })
        }
    },
    mounted(){
        this.getTopCategories()
    }

}
</script>
