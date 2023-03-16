<template>
    <div>
        <div v-if="this.$route.path == '/home'">
            <h3>Categorieën</h3>
            <div class="categories__holder">
                <div class="categories__item--all-blogs">
                    Alle blogs
                </div>
    
                <sideBarCategoriesItemSkeleton v-if="!categories"/>
                <sideBarCategoriesItem v-for="category in categories" :category="category" v-else/>
    
                <router-link to="/categories" class="categories__item--all-categories">
                    Bekijk alle Categorieën
                </router-link>
            </div>
        </div>

        <div v-else class="categories__holder">
            <template v-if="users">
                <h3 v-if="this.$route.path == '/detail/' + this.$route.params.id">{{users[0].user.username}}'s Categorieën</h3>
                <h3 v-else>{{users.username}}'s Categorieën</h3>
            </template>
            <div class="categories__holder">
                <router-link to="/blogs" class="categories__item--all-categories">
                    Alle blogs
                </router-link>
    
                <sideBarCategoriesItemSkeleton v-if="!categories"/>
                <sideBarCategoriesItem v-for="category in categories" :category="category" v-else/>
            </div>
        </div>
   
    </div>
</template>

<script setup>
    import axios from 'axios';
    import sideBarCategoriesItemSkeleton from './SideBarCategoriesItemSkeleton.vue';
    import sideBarCategoriesItem from './SideBarCategoriesItem.vue';
</script>

<script>
    export default {
        name: "SideBarCategories",
        props: [
            'users'
        ],

        data(){
            return {
                'categories': null,
            }
        },

        methods: {
            /* get all the categories */
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
