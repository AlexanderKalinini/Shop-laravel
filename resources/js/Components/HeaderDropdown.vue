<script>
import axios from "axios";

export default {
    props: {
        userName: String,
    },
    methods: {
        async logout() {
            try {
                await axios.get("/sanctum/csrf-cookie");
                await axios.delete("/api/logout");
            } catch (err) {
                console.log(err);
            }

            this.$store.commit("getUser", null);
        },
    },
};
</script>
<template>
    <div
        class="absolute -right-20 top-0 z-50 mt-14 w-[280px] rounded-lg bg-card p-4 shadow-xl xs:-right-8 sm:right-0 sm:w-[300px]"
    >
        <h5 class="text-xs text-body">Мой профиль</h5>
        <div class="mt-3 flex items-center">
            <img
                src="/images/avatar.jpg"
                class="h-11 w-11 rounded-full"
                alt="Александр Калинин"
            />
            <span class="ml-3 text-xs font-bold md:text-sm">{{
                userName
            }}</span>
        </div>
        <div class="mt-4">
            <ul class="space-y-2">
                <li>
                    <router-link
                        :to="{ name: 'orders' }"
                        class="text-xs font-medium text-body hover:text-white"
                        >Мои заказы</router-link
                    >
                </li>
                <li>
                    <router-link
                        :to="{ name: 'edit.profile' }"
                        class="text-xs font-medium text-body hover:text-white"
                        >Редактировать профиль</router-link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-6">
            <button
                @click="logout"
                class="inline-flex items-center text-body hover:text-pink"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="m19.026 7.643-3.233-3.232a.833.833 0 0 0-1.178 1.178l3.232 3.233c.097.098.18.207.25.325-.012 0-.022-.007-.035-.007l-13.07.027a.833.833 0 1 0 0 1.666l13.066-.026c.023 0 .042-.012.064-.014a1.621 1.621 0 0 1-.278.385l-3.232 3.233a.833.833 0 1 0 1.178 1.178l3.233-3.232a3.333 3.333 0 0 0 0-4.714h.003Z"
                    />
                    <path
                        d="M5.835 18.333H4.17a2.5 2.5 0 0 1-2.5-2.5V4.167a2.5 2.5 0 0 1 2.5-2.5h1.666a.833.833 0 1 0 0-1.667H4.17A4.172 4.172 0 0 0 .002 4.167v11.666A4.172 4.172 0 0 0 4.169 20h1.666a.833.833 0 1 0 0-1.667Z"
                    />
                </svg>
                <span class="ml-2 font-medium">Выйти</span>
            </button>
        </div>
    </div>
</template>
