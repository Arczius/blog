<template>
    <div class="login__holder">
        <img class="login__background-image" :src="(Math.floor(Math.random() * 5) === 3 ) ? Tyler : LoginImage" alt="">
        <LoginForm/>
    </div>
</template>

<style scoped>
</style>

<script setup>
import LoginForm from './components/LoginForm.vue';
import Tyler from '../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
import LoginImage from '../../../assets/writing.png';
</script>

<script>
export default {
    name: "Index",
    methods: {
        callParentProfileSetter()
        {
            this.$parent.$options.methods.getUserProfilePicture()
        }
    }
}
</script>
