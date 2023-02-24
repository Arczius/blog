<template>
    <div class="register__form">
        <h3 class="register__title">Registreren</h3>

        <div v-if="errors !== null" class="register__errors">
            <div v-for="error in errors" class="register__errors--error">
                {{ error[0] }}
            </div>
        </div>

        <div>
            <input v-model="name" class="register__input register__input--username" type="text" placeholder="Naam">
        </div>


        <div>
            <input v-model="handle" class="register__input register__input--username"  type="text" placeholder="Gebruikersnaam">
        </div>

        <div>
            <input v-model="email" class="register__input register__input--email" type="email" placeholder="Email">
        </div>

        <div>
            <input v-model="password" class="register__input register__input--password"  type="password" placeholder="Wachtwoord">
        </div>

        <div>
            <input v-model="checkbox" type="checkbox">
            <span>Ja, ik ga akkoord met de privacyverklaring</span>
        </div>

        <div>
            <button class="register__button" @click="sendRegisterRequest()">Registreren</button>
        </div>


        <div class="register__spacer">

        </div>

        <div class="register__bottom-links">
            <div>
                <router-link class="register__bottom-links--password-forget" to="/">
                    Inloggen
                </router-link>
            </div>
        </div>


    </div>
</template>

<script setup>
import axios from 'axios'
</script>

<script>

export default {
    name: "RegisterForm",

    data(){
        return {
            'handle': null,
            'password': null,
            'checkbox': false,
            'name': null,
            'email': null,
            'errors': null,
        }
    },

    methods: {
        sendRegisterRequest(){
            if(this.checkbox){

                axios.post("/api/auth/create", {
                    'username': this.name,
                    'handle': this.handle,
                    'email': this.email,
                    'password': this.password,
                })
                .then((response) => {

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

                }
            }
    },
}
</script>
