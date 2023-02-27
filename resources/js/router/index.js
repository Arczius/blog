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
        component: () => import('../views/BlogCreate/Index.vue')
    },
    {
        component: () => import('../views/BlogDetails/Index.vue')
        path: '/store',
        name: 'store',
        component: () => import('../views/BlogDetails/Index.vue')
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
