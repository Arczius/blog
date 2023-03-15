<template>
    <div>
        <h3>Categorieën</h3>
        <div class="page_holder">
            <SideBar/>
            <MainContainer/>
        </div>
    </div>

</template>

<script setup>
import SideBar from './components/SideBar.vue';
import MainContainer from './components/MainContainer.vue' ;
</script>

<style>
.page_holder {
    display: flex;
    gap: 2rem;
}
</style>

<script>
export default {
    name: 'Categories'
}
</script>
