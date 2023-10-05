<script setup>
import { ref } from "vue";

const nav = ref([
    // {
    //     text: "Beranda",
    //     to: "/",
    // },
    {
        text: "Order",
        to: "/admin/order",
    },
    {
        text: "Product",
        to: "/admin/product",
    },
    {
        text: "Invoice",
        to: "/admin/invoice",
    },
    {
        text: "User",
        to: "/admin/user",
    },
    {
        text: "Login",
        to: "/login",
    },
]);
</script>
<template>
    <div class="landing-navbar">
        <div>
            <div class="text-xs">FIOEP</div>
            Foodia
        </div>
        <ul>
            <li
                v-for="index in nav"
                :key="index"
                :class="index.to == $route.path ? 'font-semibold' : ''"
            >
                <RouterLink :to="index.to">{{ index.text }}</RouterLink>
            </li>
        </ul>
    </div>
    <div class="py-10"></div>
</template>
