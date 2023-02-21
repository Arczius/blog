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
