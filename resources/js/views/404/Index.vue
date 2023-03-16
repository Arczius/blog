<template>
    <div class="error">
        <h3 class="error__title">
            404
        </h3>
        <p class="error__description">
            de pagina waar je voor zoekt is helaas niet vindbaar
        </p>
        <p class="error__description">
            <router-link to="/home">klik hier om terug naar de home te gaan</router-link>
        </p>
    </div>
</template>

<script>
    export default {
        name: "Error",
    }
</script>
