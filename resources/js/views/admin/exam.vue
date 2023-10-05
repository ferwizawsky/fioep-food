<script setup>
import { onMounted, ref, watch } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const paid = ref(500000);
const list = ref([]);
const loading = ref(false);
const chart = ref([
    {
        id: 1,
        title: "Example Food0",
        description: "Example",
        photo: "http:\/\/localhost:8000\/uploads\/product\/example.jpeg",
        price: 25000,
        user_id: 1,
        created_at: "2023-10-05T09:24:31.000000Z",
        updated_at: "2023-10-05T09:24:31.000000Z",
        deleted_at: null,
        value: 2,
    },
    {
        id: 2,
        title: "Example Food1",
        description: "Example",
        photo: "http:\/\/localhost:8000\/uploads\/product\/example.jpeg",
        price: 25000,
        user_id: 1,
        created_at: "2023-10-05T09:24:31.000000Z",
        updated_at: "2023-10-05T09:24:31.000000Z",
        deleted_at: null,
        value: 4,
    },
]);

watch(
    () => chart.value,
    (e) => {
        console.log(e);
    },
    {
        deep: true,
    }
);

async function getData() {
    const { data } = await axios.get("/product");
    console.log(data.data);
    list.value = data.data;
}

async function submitCheck() {
    if (getTotal(chart.value) > paid.value) {
        confirm("Paid value should above total price!");
        return;
    }
    loading.value = true;
    let fm = new FormData();
    for (let x in chart.value) {
        fm.append(`product[${x}][value]`, chart.value[x].value);
        fm.append(`product[${x}][id]`, chart.value[x].id);
    }
    fm.append("paid", paid.value);
    try {
        const data = await axios.post("/invoice", fm);
        loading.value = false;
        // console.log(data.data);
        router.push(`/admin/invoice/${data.data.data.id}`);
    } catch (error) {}
}
function getTotal(e) {
    let tmp = 0;
    for (let x in e) {
        tmp += e[x]?.value * e[x]?.price;
    }
    return tmp;
}

function thousand(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
onMounted(() => {
    getData();
});
</script>
<template>
    <!-- component -->
    <!-- This is an example component -->
    <div class="text-sm pt-10">
        <div>
            <div class="px-4 pb-20 grid lg:grid-cols-4">
                <div
                    class="lg:col-span-3 lg:pr-4 grid md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4"
                >
                    <div
                        class="relative hover:scale-105 ease-in-out duration-300 bg-white shadow-lg rounded-xl h-[300px] overflow-hidden"
                        v-for="item in list"
                    >
                        <img
                            :src="item.photo"
                            class="object-cover w-full h-[180px]"
                        />
                        <div class="p-2 px-4">
                            <div>
                                <div class="font-medium">
                                    {{ item?.title }}
                                </div>
                                <div class="font-bold">
                                    Rp. {{ thousand(item?.price) }}
                                </div>
                            </div>
                            <div class="absolute left-0 bottom-3 w-full px-4">
                                <button
                                    @click="
                                        if (
                                            chart
                                                .map((e) => e.id)
                                                .indexOf(item.id) == -1
                                        ) {
                                            chart.push({
                                                value: 1,
                                                ...item,
                                            });
                                        } else {
                                            chart[
                                                chart
                                                    .map((e) => e.id)
                                                    .indexOf(item.id)
                                            ].value += 1;
                                        }
                                    "
                                    class="btn w-full"
                                >
                                    Add to Chart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div
                        v-if="chart.length"
                        class="bg-white shadow-lg rounded-xl min-h-[100px] sticky top-24 border border-gray-100 p-4"
                    >
                        <div class="text-center font-semibold text-xl">
                            Chart
                        </div>
                        <div>
                            <div
                                v-for="item in chart"
                                class="mb-4 flex items-center"
                            >
                                <img
                                    :src="item.photo"
                                    class="w-16 h-16 object-cover rounded-full flex-none"
                                />
                                <div class="grow px-4">
                                    <div>{{ item.title }}</div>
                                    <div class="font-bold">
                                        x{{ item.value }} = Rp.
                                        {{ thousand(item?.price * item.value) }}
                                    </div>
                                </div>
                                <div class="flex-none">
                                    <button
                                        @click="
                                            chart.splice(chart.indexOf(item), 1)
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-rose-400"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <form @submit.prevent="submitCheck()" class="mt-7">
                                <div class="inputan pt-1">
                                    <span>Paid :</span>
                                    <input type="number" v-model="paid" />
                                </div>
                                <div class="text-base font-semibold py-2">
                                    Total : Rp. {{ thousand(getTotal(chart)) }}
                                </div>
                                <button class="btn w-full">Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
