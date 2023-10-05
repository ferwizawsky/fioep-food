<script setup>
import Rabbit from "../assets/rabbit.json";
</script>
<template>
    <div class="z-0">
        <div class="absolute top-0 left-0 w-full z-0">
            <svg
                class="w-1/2 lg:w-1/3"
                viewBox="0 0 938 824"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M-19 824V-11H937.58C942.244 55.617 909.992 206.435 743.665 276.768C535.756 364.686 433.301 514.788 396.817 643.448C367.63 746.375 107.444 806.702 -19 824Z"
                    fill="#74C69D"
                    fill-opacity="0.15"
                />
                <path
                    d="M-19 824V-11H581.736C584.666 55.617 564.411 206.435 459.957 276.768C329.389 364.686 265.047 514.788 242.135 643.448C223.805 746.375 60.4077 806.702 -19 824Z"
                    fill="#74C69D"
                    fill-opacity="0.15"
                />
            </svg>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 z-10 relative">
            <div class="">
                <svg
                    class="w-[200px] lg:w-[300px] absolute top-[30px] lg:top-[180px] left-1/2 -translate-x-1/2 lg:translate-x-0 lg:left-[140px]"
                    viewBox="0 0 383 384"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <rect
                        x="56.8689"
                        y="425.926"
                        width="382"
                        height="382"
                        rx="191"
                        transform="rotate(-105 56.8689 425.926)"
                        fill="url(#paint0_linear_13_907)"
                    />
                    <defs>
                        <linearGradient
                            id="paint0_linear_13_907"
                            x1="247.869"
                            y1="425.926"
                            x2="247.869"
                            y2="807.926"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#74C69D" />
                            <stop offset="1" stop-color="#C5F4D6" />
                        </linearGradient>
                    </defs>
                </svg>
                <lottie-animation
                    ref="anim"
                    :animationData="Rabbit"
                    :loop="true"
                    :autoPlay="true"
                    class="w-full lg:w-[600px]"
                />
            </div>
            <div
                class="text-lg lg:text-[40px] text-center lg:text-right px-[10px] lg:pl-[50px] lg:pr-[150px] pt-5 lg:pt-[140px] leading-snug"
            >
                Ayo Cek Diagnosa Gejala Yang Kamu Alami
                <!-- <div class="text-xl text-red pt-4 font-bold">
                    <span><del>RP. 70.000</del></span> &nbsp; &nbsp; &nbsp;
                    &nbsp; <br class="lg:hidden" />
                    <span class="text-[40px]">Rp. 24.000</span>
                </div> -->
                <div class="pt-10 text-sm lg:text-xl">
                    <button class="btn-secondary">Cek Disini !</button>
                </div>
            </div>
        </div>
    </div>
</template>
