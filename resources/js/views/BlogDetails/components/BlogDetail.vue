<template>
    <div class="create__detail__form">
        <div class="create__details">
            <div class="create__header">
                <p class="create__header create__header--title">Post aanmaken</p>
                <router-link :to="{ name: 'create'}">
                    <button class="create__header create__header__discard">X</button>
                </router-link>
            </div>

            <label for="create__details--title">Titel</label>
            <div>
                <input class="create__details--title" type="text" placeholder="Post titel">
            </div>

            <label for="create__details--description">Beschrijving</label>
            <div>
                <textarea class="create__details--description" type="text" placeholder="Post beschrijving"></textarea>
            </div>

            <label for="create__details--image">Afbeelding</label>
            <div class="create_details--image">
                <input type="file" accept="image/png, image/jpeg">
                <!-- <img src="#" alt="uploaded image"> -->
            </div>

            <div>
                <button class="create__details--button">Maak post</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BlogDetail",
        data() {
            return {
        
            };
        }
    };
</script>