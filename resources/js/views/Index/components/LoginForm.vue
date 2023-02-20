<template>
    <div class="login__form">
        <h3 class="login__title">Inloggen</h3>

        <div>
            <input class="login__input login__input--username" v-model="handle" type="text" placeholder="Gebruikersnaam">
        </div>

        <div>
            <input class="login__input login__input--password" v-model="password" type="password" placeholder="Wachtwoord">
        </div>

        <div>
            <input v-model="checkbox" type="checkbox">
            <span>Ja, ik ga akkoord met de privacyverklaring</span>
        </div>

        <div>
            <button class="login__button" @click="sendLoginRequest()">Inloggen</button>
        </div>

        <div class="login__spacer">

        </div>

        <div class="login__bottom-links">
            <div>
                <router-link class="login__bottom-links--password-forget" to="/password-forget">
                    <img :src="PadLock">
                    Wachtwoord vergeten
                </router-link>
            </div>
            <div>
                <router-link class="login__bottom-links--register" to="/register">Nog geen account?</router-link>
            </div>

        </div>


    </div>
</template>

<style scoped>
/* .login__form {
    padding: 3rem;
    background-color: white;
    border-radius: 2.43rem 2.43rem 0 0;
    display: grid;
    gap: 1rem;
    min-width: 450px;
    width: max-content;
} */

/* .login__bottom-links--password-forget {
    color: gray;
}
.login__bottom-links--password-forget img{
    height: 1rem;
    width: 1rem;
    object-fit: contain;
} */
/* .login__bottom-links--register {
    color: orange;
} */
/* .login__spacer {
    height: 7rem;
} */

/* .login__title {
    font-size: 2rem;
    font-weight: 800;
    color: blue;
}
.login__button {
    background-color: orange;
} */

/* .login__input--username,
.login__input--password {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    width: 100%;
    border: solid 2px lightgray;
    outline: none;
} */

/* .login__bottom-links{
    display: flex;
    justify-content: space-between;
} */
</style>

<script setup>
    import PadLock from '../../../../assets/padlock.png'
</script>

<script>
import axios from 'axios'

export default {
    name: "LoginForm",

    data(){
        return {
            'handle': null,
            'password': null,
            'checkbox': false,
        }
    },

    methods: {
        sendLoginRequest(){
            if(this.checkbox) {
                axios.post("/api/auth/login", {
                    'handle': this.handle,
                    'password': this.password
                })
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            }
            else {
                alert("je moet akkoord gaan met de privacyverklaring")
            }
        }
    },
}
</script>
