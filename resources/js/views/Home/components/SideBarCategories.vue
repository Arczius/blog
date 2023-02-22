<template>
    <div>
        <h3>Categorieen</h3>
        <div class="">
            <div>

            </div>

            <SideBarCategoriesItemSkeleton v-if="!categories"/>

            <div>

            </div>
        </div>
    </div>
</template>

<script setup>
import SideBarCategoriesItemSkeleton from './SideBarCategoriesItemSkeleton.vue';
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
        getCategories(){

        }
    },
}
</script>

