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
        path: '/blogs',
        name: 'blogs',
    }.
        path: '/categories',
        name: 'Categories',
        component: async () => await import('../views/Categories/Index.vue')
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
    },
    {
        path: '/tyler',
        name: 'Tyler',
        component: async () => await import('../views/Tyler/Index.vue')
    }
    },
    {
        path: '/create',
        name: 'create',
        component: () => import('../views/BlogCreate/Index.vue')
    },
    {
    },
        component: () => import('../views/BlogDetails/Index.vue')
        path: '/store',
        name: 'store',
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
