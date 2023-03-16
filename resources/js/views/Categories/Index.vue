<template>
    <div>
        <h3>Categorieën</h3>
        <div class="page_holder">
            <sideBar/>
            <mainContainer/>
        </div>
    </div>

</template>

<script setup>
    import sideBar from './components/SideBar.vue';
    import mainContainer from './components/MainContainer.vue' ;
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
