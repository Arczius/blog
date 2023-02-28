import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Index',
        component: () => import('../views/Index/Index.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: async () => await import('../views/Register/Index.vue')
    },
    {
        path: '/create',
        name: 'create',
        component: async () => await import('../views/BlogCreate/Index.vue')
    },
    {
        path: '/store',
        name: 'store',
        component: async () => await import('../views/BlogDetails/Index.vue')
    },
    {
        path: '/blogs',
        name: 'blogs',
        component: async () => import('../views/BlogDetails/Index.vue')
    },
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
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
