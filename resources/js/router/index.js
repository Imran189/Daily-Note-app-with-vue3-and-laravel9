import { createRouter, createWebHistory } from "vue-router";
import notFound from "../components/notFound.vue";
import HomeView from "../components/pages/home.vue";
import LoginView from "../components/pages/login.vue";
import HomeAdminView from "../components/pages/NoteType.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "home",
            component: HomeView,
            meta: {
                requiresAuth: false,
            },
        },

        //admin pages
        {
            path: "/admin/home",
            name: "adminHome",
            component: HomeAdminView,
            meta: {
                requiresAuth: true,
            },
        },

        //admin login
        {
            path: "/login",
            name: "LoginView",
            component: LoginView,
            meta: {
                requiresAuth: false,
            },
        },

        {
            path: "/:pathMatch(.*)*",
            name: "notfound",
            component: notFound,
            meta: {
                requiresAuth: false,
            },
        },
    ],
});

router.beforeEach((to, form) => {
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
        return { name: "LoginView" };
    }

    if (to.meta.requiresAuth == false && localStorage.getItem("token")) {
        return { name: "adminHome" };
    }
});

export default router;
