<template>
    <div class="home">
        <aside class="home__sidebar">
            <sideBar/>
        </aside>

        <main class="home__main">
            <section class="home__main--top">
                <blogCreate />
            </section>

            <section class="home__main--bottom">
                <mainSectionBottom/>
            </section>
        </main>
    </div>
</template>

<script setup>
    import sideBar from './components/SideBar.vue'
    import mainSectionBottom from './components/MainSectionBottom.vue'
    import blogCreate from "../BlogCreate/components/MainContainer.vue";
</script>

<script>
    export default {
        name: "Home",
    }
</script>
