import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/Index/Index.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: async () => await import('../views/Register/Index.vue')
    },
    {
        path: '/show',
        name: 'ShowBlog',
        component: async () => await import('../views/ShowBlog/Index.vue')
    },
    {
        path: '/home',
        name: 'Home',
        component: async () => await import ('../views/Home/Index.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
