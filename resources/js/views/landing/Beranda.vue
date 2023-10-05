<script setup>
import { onMounted, ref } from "vue";
import BerandaRabbit from "../../components/BerandaRabbit.vue";
import Navbar from "../../components/Navbar.vue";

const username = ref("");
const password = ref("");
const type = ref("password");
const url = window.baseUrl;
onMounted(() => {});

function login() {
    localStorage.setItem("token", "Login");
}
</script>
<template>
    <div class="min-h-screen text-gray-600 relative pb-20">
        <div class="px-4 pt-10 grid grid-cols-1 items-center md:grid-cols-3">
            <div class="px-10">
                <img
                    :src="`${url}/s12.jpeg`"
                    class="w-[200px] h-[200px] mx-auto object-cover rounded-full"
                />
            </div>
            <div
                class="col-span-2 text-lg lg:text-[30px] text-center lg:text-right px-[10px] lg:pl-[50px] lg:pr-[150px] pt-5 lg:pt-[140px] leading-snug"
            >
                <div class="mb-1 text-lg">Welcome !</div>
                <div class="font-semibold">
                    "Let food be thy medicine and medicine be thy food."
                </div>
                <div class="pt-10 text-sm lg:text-xl">
                    <button
                        @click="$router.push('/login')"
                        class="btn-secondary"
                    >
                        Get Started
                    </button>
                </div>
            </div>
        </div>

        <!-- <div
            class="max-w-[400px] px-4 bg-white rounded-lg shadow-md py-4 mx-auto"
        >
            <form @submit.prevent="login()" class="">
                <div class="text-center pb-4 text-xl">Join Us!</div>
                <div class="form-input">
                    <input
                        type="text"
                        v-model="username"
                        placeholder="Username"
                    />
                </div>
                <div class="form-input">
                    <input
                        :type="type"
                        v-model="password"
                        placeholder="Password"
                    />
                </div>
                <input type="submit" class="btn" value="Login" />
            </form>
        </div> -->
    </div>
</template>
