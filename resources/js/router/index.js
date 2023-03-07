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
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    {
        path: '/blogs',
        name: 'blogs',
        component: async () => import('../views/BlogStore/Index.vue')
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
    {
        path: '/edit/:id',
        name: 'edit',
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: async () => await import('../views/Register/Index.vue')
    },
    {
        path: '/profile',
        name: 'profile',
        component: async () => await import('../views/Profile/Index.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
