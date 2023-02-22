import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/Index/Index.vue')
    },
    {
        path: '/post/create',
        name: 'create',
        component: () => import('../views/BlogCreate/Index.vue')
    },
    {
        path: '/post/details',
        name: 'blogDetails',
        component: () => import('../views/BlogDetails/Index.vue')
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
