<script setup>
import Navbar from "../../components/Navbar.vue";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import { RouterLink, RouterView, useRouter } from "vue-router";

const profile = ref({
    username: "",
    name: "",
});

async function getProfile() {
    try {
        const data = await axios.get(`/auth/profile`);
        console.log(data);
        profile.value = data.data.data;
    } catch (e) {
        console.log(e);
    }
}

async function logout() {
    try {
        const data = await axios.get(`/auth/logout`);
    } catch (e) {
    } finally {
        localStorage.removeItem("token");
        location.reload();
    }
}
onMounted(() => {
    getProfile();
});
</script>
<template>
    <div class="">
        <Navbar />
        <RouterView />
    </div>
</template>
<style>
.nav {
    @apply hidden items-center md:flex;
}
.nav li {
    @apply mx-4 hover:text-primary text-sm;
}
</style>
