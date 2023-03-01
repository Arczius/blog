<template>
    <div class="blog__detail__holder">
        <div class="blog__detail__header">
            <div class="blog__detail__header--inner-left">
                <button class="blog__detail__header blog__header__categories">Creativiteit</button> 
                <button class="blog__detail__header blog__header__categories">Cultuur</button> 
                <button class="blog__detail__header blog__header__categories">Lifestyle</button> 
                <button class="blog__detail__header blog__header__categories">Reizen</button> 
            </div>

            <div class="blog__detail__header--inner-right">
                <!-- <span class="blog__header__text blog__header__text--timestamp">{{blog.created_at}}</span>  -->
                <span class="blog__detail__header__text blog__detail__header__text--timestamp">25-02-2023</span>
                <button @click="editBlog()"><img class="blog__detail__header__image blog__detail__header__image--edit" :src="defaultEditIcon"></button>
                <button @click="deleteBlog()"><img class="blog__detail__header__image blog__detail__header__image--delete" :src="defaultDeleteIcon"></button>
            </div>
        </div>

        <div class="blog__detail__content">
            <!-- <p class="blog__content blog__content--title">{{blog.title}}</p> -->
            <!-- <p class="blog__content blog__content--description">{{blog.description}}</p>  -->
            <!-- <img class="blog__content blog__content--image" :src="(blog.file !== '') ? 'storage/BlogPictures/' + blog.file : DefaultBlogPicture" alt="image" loading="lazy"> -->

            <h2 class="blog__detail__content blog__detail__content--title">Dit is de titel van een blog</h2>
            <span class="blog__detail__content blog__detail__content--description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis fermentum dui. 
                Morbi lacinia molestie consequat. Morbi vitae lectus sed purus volutpat ultrices eu vel lacus. 
                Vestibulum non leo cursus, molestie nisl ac, molestie est. Maecenas a augue vel turpis cursus egestas. 
                Cras dui ante, aliquet vitae gravida non, ornare ac nulla. Praesent porta cursus augue et accumsan. 
                Integer dignissim ex vel quam volutpat, ut suscipit ante ultrices. Ut facilisis sollicitudin mauris in maximus. 
                Nunc turpis sapien, accumsan non felis id, tempus finibus arcu. In non nisi nec ante dapibus blandit rhoncus sed ipsum. 
                In fermentum lobortis felis, sed euismod est molestie non.
            </span>
            <img class="blog__detail__content blog__detail__content--image" :src="defaultBlogPicture" alt="image" loading="lazy">
        </div>

        <div class="blog__detail__comments">
            <span class="blog__detail__comments blog__detail__comments--textComment">Reacties</span>
            
            <div class="blog__detail__commentsDiv">
                <img class="blog__detail__comments blog__detail__comments--profilePicture" :src="defaultCommentIcon">
                <input class="blog__detail__comments blog__detail__comments--text" type="text" placeholder="Schrijf een reactie...">
            </div>
        </div>
    </div>
</template>

<script setup>
    import defaultBlogPicture from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
    import defaultCommentIcon from '../../../../assets/writing.png'
    import defaultEditIcon from '../../../../assets/draw.png'
    import defaultDeleteIcon from '../../../../assets/bin.png'
</script>

<script>
import axios from 'axios'
export default {
    name: "BlogDetail",
    props: [
        'blog',
    ],

    methods: {
         /* go to the destroy route with the id */
         deleteBlog() {
           axios.delete('/api/blog/destroy/' + this.blog.id, {
                'id': this.id,
            },
            {
                headers: { "Content-Type" : "application/json"}
            })
            /* reload the page */
            .then((response) =>  {  
                console.log(response)
                location.reload();
                this.blog.id = response.data.id 
            })
            .catch(function (error) {  
                console.log(error);
            });
        },

        /* go to the edit route */
        editBlog(){
            this.$router.push('/edit/' + this.blog.id);
        },
    }
}
</script>
