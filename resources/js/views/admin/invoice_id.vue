<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const tanggal = ref(["2023-01-01", new Date().toISOString().split("T")[0]]);
const listData = ref({});
async function getUser() {
    listData.value = [];
    try {
        const { data } = await axios.get(`/invoice/${route.params.id}`);
        console.log(data);
        listData.value = data.data;
    } catch (e) {
        if (e.response.request.status == 401) {
            localStorage.removeItem("token");
            location.reload();
        }
    }
}

onMounted(() => {
    getUser();
});

function dateFormatter(e) {
    return new Date(e).toLocaleString("id", {
        day: "2-digit",
        month: "long",
        year: "numeric",
    });
}

function thousand(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function download_excel() {
    window.open(
        `${window.axios.defaults.baseURL}greenhouse/export?from=${tanggal.value[0]}&to=${tanggal.value[1]}`
    );
}

function hourFormatter(e) {
    let tmp = new Date(e).toISOString().split("T")[1].substr(0, 5);
    return tmp;
}
</script>
<template>
    <div class="max-w-2xl mx-auto">
        <div
            class="w-full text-sm border border-gray-200 bg-white rounded-xl shadows p-6 max-h-[85vh] overflow-auto"
        >
            <div class="text-xl text-center">Detail Invoice</div>
            <div class="pt-4 grid grid-cols-3 gap-4">
                <div>
                    <div>ID Transaction</div>
                    <div>Note</div>
                    <div>Paid</div>
                    <div>Total Price</div>
                    <div>Product</div>
                </div>
                <div class="col-span-2">
                    <div>: {{ listData.id }}</div>
                    <div>: {{ listData.note ?? "-" }}</div>
                    <div>
                        : Rp.
                        {{ listData?.paid ? thousand(listData?.paid) : "" }}
                    </div>
                    <div>
                        : Rp.
                        {{ listData?.price ? thousand(listData?.price) : "" }}
                    </div>
                    <div>
                        :
                        <div class="px-4">
                            <div
                                class="mb-4 flex items-center"
                                v-for="item in listData?.product"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
