<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

onMounted(() => {
    // let token = localStorage.getItem("token");
    // if (token) {
    //     axios
    //         .get("/cek")
    //         .then((e) => {
    //             console.log("success");
    //         })
    //         .catch((e) => {
    //             //logout
    //             localStorage.removeItem("token");
    //             console.log("failed");
    //             location.reload();
    //         });
    // } else {
    // }
});
</script>
<template>
    <RouterView />
</template>
