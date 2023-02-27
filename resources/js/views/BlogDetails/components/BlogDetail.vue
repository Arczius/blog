<template>
    <div class="create__detail__form">
        <div class="create__details">
            <div class="create__header">
                <p class="create__header create__header--title">Post aanmaken</p>
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
                <button @click='sendRequest()' class="create__details--button">Maak post</button>
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
            };
        },

        methods: {
            getFile() {
                this.coverFile = this.$refs.coverFile.files[0]
			    this.file = this.$refs.files.files[0]
		    },

            sendRequest() {
			    axios.post('/api/blog/store', {
                    'title': this.title,
                    'description': this.description,
				},
				{
					headers: { "Content-Type" : "application/json"}
				}
				)
                .then((response) =>  {  
                    console.log(response)
                    this.blogid = response.data.id 
                })
                .then(() => {
                    if(this.coverFile) {
					axios.post('/api/blog/file/' + this.blogid, {
						'coverFile': this.coverFile,
                        'file': this.file
					},
					{
						headers: {"Content-Type" : "multipart/form-data"}
					})
					.then((response) => {
						console.log(response)
					})
				}
                })  
                .catch(function (error) {  
                    console.log(error);
                });
			}
        }
        
    };
</script>