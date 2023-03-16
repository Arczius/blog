import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    // path to login
    {
        path: '/',
        name: 'Login',
        component: () => import('../views/Index/Index.vue')
    },
    // path to the create a new blog 
    {
        path: '/create',
        name: 'Create a blog',
        component: async () => await import('../views/BlogCreate/Index.vue')
    },
    // path to store a blog into the database
    {
        path: '/store',
        name: 'store',
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    // path to get all the existing blogs
    {
        path: '/blogs',
        name: 'All blogs',
        component: async () => import('../views/BlogStore/Index.vue')
    },
    // path to go to the detail page
    {
        path: '/detail/:id',
        name: 'Blog Detail',
        component: async () => await import('../views/BlogDetail/Index.vue')
    },
    // path to go to the home page
    {
        path: '/home',
        name: 'Home',
        component: async () => await import('../views/Home/Index.vue')
    },

    // most important route, don't delete, it will crash the entire app
    {
        path: '/tyler',
        name: 'Tyler',
        component: async () => await import('../views/Tyler/Index.vue')
    },
    // path to edit a blog
    {
        path: '/edit/:id',
        name: 'Edit Blog',
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    // path to register a new account
    {
        path: '/register',
        name: 'Register',
        component: async () => await import('../views/Register/Index.vue')
    },
    // path to go to a personal user profile
    {
        path: '/profile/user/:id',
        name: 'User Profile',
        component: async () => await import('../views/Profile/Index.vue')
    },
    // path to edit an user
    {
        path: '/user/edit',
        name: 'Edit User',
        component: async () => await import('../views/user/Edit/Index.vue')
    },
    // path to go to all the categories
    {
        path: '/categories',
        name: 'Alle categories',
        component: async () => await import('../views/Categories/Index.vue')
    },
    // keep this at the bottom of the array, otherwise all pages will throw an 404
    {
        path: '/:pathMatch(.*)*',
        name: '404 - Page not found',
        component: async () => await import('../views/404/Index.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
