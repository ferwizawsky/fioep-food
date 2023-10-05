<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { onMounted, ref } from "vue";

const tanggal = ref(["2023-01-01", new Date().toISOString().split("T")[0]]);
const listData = ref([]);
const formUser = ref({
    title: "Test",
    description: "test",
    price: 15550,
    image: null,
});

async function getUser() {
    listData.value = [];
    try {
        const { data } = await axios.get(`/product?limit=1000`);
        console.log(data);
        listData.value = data.data;
    } catch (e) {
        if (e.response.request.status == 401) {
            localStorage.removeItem("token");
            location.reload();
        }
    }
}

async function addUser() {
    listData.value = [];
    try {
        let fm = new FormData();
        for (let x in formUser.value) {
            fm.append(x, formUser.value[x]);
        }
        const { data } = await axios.post(`/product`, fm);
        formUser.value = {
            title: "",
            description: "",
            price: 0,
            image: null,
        };
        getUser();
    } catch (e) {
        console.log(e);
    }
}

async function deleteUser(e) {
    if (confirm(`Do you want to Delete ${e.name} !`)) {
        try {
            const { data } = await axios.delete(`/product/${e.id}`);
            console.log(data);
            getUser();
        } catch (e) {
            console.log(e);
        }
    } else {
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
    <div class="max-w-4xl mx-auto">
        <div class="mt-[25px]">
            <form
                @submit.prevent="addUser()"
                class="grid md:grid-cols-3 gap-x-4"
            >
                <div class="inputan">
                    <span>Title</span>
                    <input type="text" v-model="formUser.title" required />
                </div>
                <div class="inputan">
                    <span>Description</span>
                    <input
                        type="text"
                        v-model="formUser.description"
                        required
                    />
                </div>

                <div class="inputan">
                    <span>Price</span>
                    <input type="text" v-model="formUser.price" required />
                </div>

                <div class="inputan">
                    <span>Image</span>
                    <input
                        type="file"
                        @change="formUser.image = $event.target.files[0]"
                        required
                    />
                </div>

                <div>
                    <br />
                    <button class="btn">Add User</button>
                </div>
            </form>
        </div>

        <div
            class="w-full text-sm border border-gray-200 bg-white rounded-xl shadows p-4 pt-10 mt-6 max-h-[65vh] overflow-auto"
        >
            <div class="px-4">
                <table class="table-auto w-[600px] md:w-full">
                    <thead>
                        <tr class="text-left">
                            <th>No.</th>
                            <th>Photos</th>
                            <th>Title</th>
                            <th>Price</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="border-t"
                            v-for="(index, item, a) in listData"
                            :key="index"
                        >
                            <td class="pr-6 py-2">{{ item + 1 }}.</td>
                            <td class="pr-6 py-2">
                                <img
                                    :src="index.photo"
                                    class="w-16 h-16 object-cover rounded-full flex-none"
                                />
                            </td>
                            <td class="pr-6 py-2">{{ index.title }}</td>
                            <td class="pr-6 py-2">{{ index.price }}</td>
                            <td class="pr-6 py-2 hidden">
                                <!-- {{ hourFormatter(index.created_at) }}
              {{ dateFormatter(index.created_at) }} -->

                                <Menu
                                    as="div"
                                    class="relative inline-block text-left"
                                >
                                    <div>
                                        <MenuButton
                                            class="p-2 rounded-lg text-primary bg-primary/10"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                id="Outline"
                                                viewBox="0 0 24 24"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M7,0H4A4,4,0,0,0,0,4V7a4,4,0,0,0,4,4H7a4,4,0,0,0,4-4V4A4,4,0,0,0,7,0ZM9,7A2,2,0,0,1,7,9H4A2,2,0,0,1,2,7V4A2,2,0,0,1,4,2H7A2,2,0,0,1,9,4Z"
                                                />
                                                <path
                                                    fill="currentColor"
                                                    d="M20,0H17a4,4,0,0,0-4,4V7a4,4,0,0,0,4,4h3a4,4,0,0,0,4-4V4A4,4,0,0,0,20,0Zm2,7a2,2,0,0,1-2,2H17a2,2,0,0,1-2-2V4a2,2,0,0,1,2-2h3a2,2,0,0,1,2,2Z"
                                                />
                                                <path
                                                    fill="currentColor"
                                                    d="M7,13H4a4,4,0,0,0-4,4v3a4,4,0,0,0,4,4H7a4,4,0,0,0,4-4V17A4,4,0,0,0,7,13Zm2,7a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V17a2,2,0,0,1,2-2H7a2,2,0,0,1,2,2Z"
                                                />
                                                <path
                                                    fill="currentColor"
                                                    d="M20,13H17a4,4,0,0,0-4,4v3a4,4,0,0,0,4,4h3a4,4,0,0,0,4-4V17A4,4,0,0,0,20,13Zm2,7a2,2,0,0,1-2,2H17a2,2,0,0,1-2-2V17a2,2,0,0,1,2-2h3a2,2,0,0,1,2,2Z"
                                                />
                                            </svg>
                                        </MenuButton>
                                    </div>

                                    <div class="relative z-30">
                                        <transition
                                            enter-active-class="transition duration-100 ease-out"
                                            enter-from-class="transform scale-95 opacity-0"
                                            enter-to-class="transform scale-100 opacity-100"
                                            leave-active-class="transition duration-75 ease-in"
                                            leave-from-class="transform scale-100 opacity-100"
                                            leave-to-class="transform scale-95 opacity-0"
                                        >
                                            <MenuItems
                                                class="absolute right-0 mt-2 w-40 z-30 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            >
                                                <div class="px-1 py-1">
                                                    <!-- <MenuItem v-slot="{ active }">
                          <button
                            @click="$router.push(`/`)"
                            :class="[
                              active
                                ? 'bg-primary text-white'
                                : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]"
                          >
                            Go Exam
                          </button>
                        </MenuItem>  -->
                                                    <MenuItem
                                                        v-slot="{ active }"
                                                    >
                                                        <button
                                                            @click="
                                                                deleteUser(
                                                                    index
                                                                )
                                                            "
                                                            :class="[
                                                                active
                                                                    ? 'bg-primary text-white'
                                                                    : 'text-gray-900',
                                                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                                            ]"
                                                        >
                                                            Delete
                                                        </button>
                                                    </MenuItem>
                                                </div>
                                            </MenuItems>
                                        </transition>
                                    </div>
                                </Menu>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center pt-4">
                <!-- <button
        v-if="!isMax"
        @click="loadMore()"
        class="bg-primary/20 text-primary px-10 py-2 rounded-full"
      >
        Load More
      </button> -->
            </div>
        </div>
    </div>
</template>
