<template>
    <div class="create__detail__form">
        <div class="create__details">
            <div class="create__header">
                <!-- If the route is /store show 'post aanmaken', else show 'post bewerken' -->
                <p v-if="this.$route.path == '/store'" class="create__header create__header--title">Post aanmaken</p>
                <p v-else class="create__header create__header--title">Post bewerken</p>

                <router-link :to="{name: 'profile'}">
                    <button class="create__header create__header__discard">X</button>
                </router-link>
            </div>

            <label for="create__details--title">Titel</label>
            <div>
                <input class="create__details--title" v-model="title" type="text" placeholder="Post titel...">
            </div>

            <label for="create__details--description">Beschrijving</label>
            <div>
                <textarea class="create__details--description" v-model="description" type="text" placeholder="Post beschrijving..."></textarea>
            </div>

            <label for="create__details--image">Omslag afbeelding</label>
            <div class="create_details--image">
                <input v-on:change="getFile()" type="file" ref="coverFile">
            </div>

            <label for="create__details--image">Afbeelding</label>
            <div class="create_details--image">
                <input v-on:change="getFile()" type="file" ref="files">
            </div>

            <div>
                <button @click='sendRequest()' v-if="this.$route.path == '/store'" class="create__details--button">Maak post</button>
                <button @click='sendEditRequest()' v-else class="create__details--button">Bewerk post</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "store",
        data() {
            return {
                'title': null,
                'description': null,
                'coverFile': null,
                'file': null,
                'blogid': null,
                'id': this.$route.params.id

        props: [
            'blog',
            'user'
        ],

        data() {
            var title = null;
            var description = null;

            if (this.blog !== undefined) {
                title = this.blog.blog.title;
                description = this.blog.blog.description;
            }

            return {
                'title': title,
                'description': description,
                'coverFile': null,
                'file': null,
                'blogid': null,
                'id': this.$route.params.id,
                'user_id': this.user.id,
            };
        },

        methods: {
            getFile() {
                this.coverFile = this.$refs.coverFile.files[0]
			    this.file = this.$refs.files.files[0]
		    },

            /* go to the store route */
            sendRequest() {
			    axios.post('/api/blog/store', {
                    'title': this.title,
                    'description': this.description,
                    'user_id': this.user.id,
				},
				{
					headers: {"Content-Type" : "application/json"}
				}
				)
                .then((response) =>  {  
                    console.log(response)
                    this.blogid = response.data.id 
                })
                /* send the files to the file route */
                .then(() => {
                    if(this.coverFile) {
					axios.post('/api/blog/file/' + this.blogid, {
						'coverFile': this.coverFile,
                        'file': this.file
					},
					{
						headers: {"Content-Type" : "multipart/form-data"}
					})
                    /* redirect to the profile page */
					.then((response) => {
						console.log(response)
                        this.$router.push("/profile");
					})
				}
                })  
                .catch(function (error) {  
                    console.log(error);
                });
			},

            /* go to the edit route */
            sendEditRequest() {
			    axios.post('/api/blog/edit/' + this.id, {
                    'title': this.title,
                    'description': this.description,
				},
				{
					headers: {"Content-Type" : "application/json"}
				}
				)
                .then((response) =>  {  
                    console.log(response)
                    this.id = response.data.id 
                    this.$router.push("/profile");
                })
                 /* send the files to the file route */
                .then(() => {
                    if(this.coverFile) {
					axios.post('/api/blog/file/' + this.id, {
						'coverFile': this.coverFile,
                        'file': this.file
					},
					{
						headers: {"Content-Type" : "multipart/form-data"}
					})
                    /* redirect to the profile page */
					.then((response) => {
						console.log(response)
                        this.$router.push("/profile");
					})
				}
                })
                .catch(function (error) {  
                    console.log(error);
                });
            },

        }, 
    };