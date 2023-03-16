<template>
    <main>
        <mainContainerItemSkeleton v-if="categories === null"/>

        <mainContainerItem v-else v-for="category in categories" :category="category"/>

    </main>
</template>

<style scoped>
main {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    flex-grow: 1;
    padding: 0.8rem;
}
</style>

<script setup>
    import mainContainerItemSkeleton from './MainContainerItemSkeleton.vue'
    import mainContainerItem from './MainContainerItem.vue';
    import axios from 'axios'
</script>


<script>
    export default {
        name: "MainContainer",
        data(){
            return {
                'categories': null,
            }
        },
        methods: {
            /* get all the categories */
            getAllCategories(){
                axios.get('/api/category')
                    .then((response) => {
                        this.categories = response.data.categories
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            }
        },
        mounted(){
            this.getAllCategories()
        }
    }
</script>
