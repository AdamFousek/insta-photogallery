import { createRouter, createWebHistory } from 'vue-router';
import Homepage from './Pages/Homepage.vue'
import Login from './Pages/Login.vue'
import Register from './Pages/Register.vue'
import NotFound from './Pages/NotFound.vue'
import { useUserStore } from "./stores/userStore";
import Profile from "./Pages/Profile.vue";
import UserDetail from "./Pages/UserDetail.vue";
import HeaderTitle from "./Layout/HeaderTitle.vue";

const routes = [
    {
        path: '/',
        name: 'homepage',
        components: {
            default: Homepage,
            header: HeaderTitle
        },
        props: () => ({ header: 'Homepage' })
    },
    {
        path: '/login',
        name: 'login',
        components: {
            default: Login,
            header: HeaderTitle
        },
        props: () => ({ header: 'Login' })
    },
    {
        path: '/register',
        name: 'register',
        components: {
            default: Register,
            header: HeaderTitle
        },
        props: () => ({ header: 'Register' })
    },
    {
        path: '/profile/:username',
        name: 'userDetail',
        component: UserDetail,
        props: true,
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/not-found',
        alias: ['/:pathMatch(.*)*'],
        name: 'notFound',
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const store = useUserStore()
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.user) {
            next({
                name: "login",
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router