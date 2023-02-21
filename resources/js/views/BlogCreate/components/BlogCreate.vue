<template>
    <div class="create__form">
        <div>
            <img class="create__image" :src="ProfilePicture">
        </div>

        <div>
            <button @onclick="toggleComponent" class="create__input">Maak een blog</button>
        </div>

        <detail-component v-if="showComponent"/>
    </div>
</template>

<script setup>
    import ProfilePicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
</script>

<script>
export default {
    name: "BlogCreate",
    components: {
        BlogDetail,
    },

    data(){
        return {
            showComponent: false,
        }
    },

    methods: {
        toggleComponent () {
            this.showComponent = !this.showComponent;
        }
    },
}
</script>
