<template>
    <div class="create__form">
        <div class="create__blog--title">
            <input type="text" placeholder="Titel">
        </div>

        <div class="create_blog--description">
            <textarea type="text" placeholder="Beschrijving"></textarea>
        </div>

        <div class="create_blog--image">
            <img>
        </div>

        <div>
            <button>Maak post</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogDetail",
    data() {
        return {
            message: "Component loaded"
        };
    }
};
</script>