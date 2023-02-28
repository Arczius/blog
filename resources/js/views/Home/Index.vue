<template>
    <div class="home">
        <aside class="home__sidebar">
            <SideBar/>
        </aside>

        <main class="home__main">
            <section class="home__main--top">
                <BlogCreate />
            </section>

            <section class="home__main--bottom">
                <MainSectionBottom/>
            </section>
        </main>
    </div>
</template>

<style scoped>
</style>

<script setup>
import SideBar from './components/SideBar.vue'
import MainSectionBottom from './components/MainSectionBottom.vue'
import BlogCreate from "../BlogCreate/components/BlogCreate.vue";
</script>

<script>
export default {
    name: "Home"
}
</script>
