import "./bootstrap";
import "../css/app.css";
import "../css/form.css";
import LottieAnimation from "lottie-web-vue";


import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";


createApp(App).use(router).use(LottieAnimation).mount("#app");
