<template>
    <div class="login__form">
        <h3 class="login__title">Inloggen</h3>

        <div v-if="errors !== null" class="register__errors">
            <div v-for="error in errors" class="register__errors--error">
                {{ error[0] }}
            </div>
        </div>

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
import axios from 'axios'
</script>

<script>

export default {
    name: "LoginForm",

    data(){
        return {
            'handle': null,
            'password': null,
            'checkbox': false,
            'errors': null
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
                        localStorage.setItem('token', response.data.token)
                        localStorage.setItem('userID', response.data.id)

                        axios.post("/api/auth", {
                            'token': localStorage.getItem('token'),
                            'userID' : localStorage.getItem('userID'),
                        })
                            .then((response) => {
                                console.log(response)
                            })
                    })
                    .catch((error) => {
                        switch(error.response.status){
                            case 400:
                                this.errors = error.response.data.errors
                                break;
                        }
                    })
            }
            else {
                alert("je moet akkoord gaan met de privacyverklaring")
            }
        }
    },
}
</script>
