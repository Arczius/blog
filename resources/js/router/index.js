import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () => import('../views/Index/Index.vue')
    },
    {
        path: '/create',
        name: 'Create a blog',
        component: async () => await import('../views/BlogCreate/Index.vue')
    },
    {
        path: '/store',
        name: 'store',
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    {
        path: '/blogs',
        name: 'All blogs',
        component: async () => import('../views/BlogStore/Index.vue')
    },
    {
        path: '/detail/:id',
        name: 'Blog Detail',
        component: async () => await import('../views/BlogDetail/Index.vue')
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
        name: 'Edit Blog',
        component: async () => await import('../views/BlogStore/Index.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: async () => await import('../views/Register/Index.vue')
    },
    {
        path: '/profile/user/:id',
        name: 'User Profile',
        component: async () => await import('../views/Profile/Index.vue')
    },
    {
        path: '/user/edit',
        name: 'Edit User',
        component: async () => await import('../views/user/Edit/Index.vue')
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
