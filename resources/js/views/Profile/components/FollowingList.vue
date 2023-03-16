<template>
    <div>
        <h2>
            {{ Title }}
        </h2>
        <div class="following_users_table" >

            <div v-for="user in Users" class="following_users_table__item">
                <div>
                    <router-link :to="'/profile/user/' + user.id">                     
                        <img :src="'/storage/ProfilePictures/' + user.profile_picture" alt="">
                    </router-link>
                </div>
                <div>
                    <router-link :to="'/profile/user/' + user.id">
                        <h4>@{{ user.handle }}</h4>
                    </router-link>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'Following List',

    props: {
        Users: {
            default: null,
            type: Array
        },
        Title: {
            default: "title:",
            type: String,
        }
    }
}
</script>