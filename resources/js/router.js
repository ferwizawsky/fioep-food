import { createWebHistory, createRouter } from "vue-router";

const Beranda = () => import("@/views/landing/Beranda.vue");
const Login = () => import("@/views/login.vue");

const routes = [
    {
        path: "/",
        name: "Beranda",
        component: Beranda,
        meta: {
            public: true,
        },
    },
    {
        path: "/login",
        name: "Login",
        component: Beranda,
        meta: {
            public: true,
        },
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            public: true,
        },
    },
    {
        path: "/admin",
        name: "Base Admin",
        redirect: "/admin/order",
        component: () => import("@/views/admin/base.vue"),
        children: [
            {
                path: "/admin/order",
                name: "Admin Order",
                component: () => import("@/views/admin/exam.vue"),
            },
            {
                path: "/admin/invoice",
                name: "Admin invoice",
                component: () => import("@/views/admin/invoice.vue"),
            },
            {
                path: "/admin/invoice/:id",
                name: "Admin invoice Id",
                component: () => import("@/views/admin/invoice_id.vue"),
            },
            {
                path: "/admin/product",
                name: "Admin product",
                component: () => import("@/views/admin/product.vue"),
            },
            {
                path: "/admin/user",
                name: "Admin User",
                component: () => import("@/views/admin/user.vue"),
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    // Ubah judul halaman
    document.title = to.name + " | " + appName;

    const token = localStorage.getItem("token");
    const privateRoute = to.matched.some((record) => !record.meta.public);
    const publicRoute = to.matched.some((record) => record.meta.public);
    if (privateRoute && !token) next("/");
    if (to.name == "Login" && token) next("/admin");
    else next();
});

export default router;
