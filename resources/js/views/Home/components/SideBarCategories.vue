<template>
    <div>
        <h3>Categorieen</h3>
        <div class="categories__holder">
            <div class="categories__item--all-blogs">
                Alle blogs
            </div>

            <SideBarCategoriesItemSkeleton v-if="!categories"/>
            <SideBarCategoriesItem v-for="category in categories" :category="category" v-else/>

            <router-link to="/categories" class="categories__item--all-categories">
                Bekijk alle categorieen
            </router-link>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import SideBarCategoriesItemSkeleton from './SideBarCategoriesItemSkeleton.vue';
import SideBarCategoriesItem from './SideBarCategoriesItem.vue';
</script>

<script>
export default {
    name: "SideBarCategories",
    data(){
        return {
            'categories': null,
        }
    },

    methods: {
        getCategories(amount = 6){
            axios.get(`/api/category/amount/${amount}`)
                .then((response) => {
                    this.categories = response.data.categories
                })
                    .catch((error) => {
                        console.warn(error)
                    })
        }
    },
    mounted(){
        this.getCategories()
    }
}
</script>
