<script>
import axios from "axios";
import router from "../router/router";

export default {
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            errors: null,
        };
    },
    methods: {
        async getToken() {
            await axios.get("/sanctum/csrf-cookie");
        },
        async submit() {
            await this.getToken();
            axios.defaults.withCredentials = true;
            try {
                await axios.post(
                    "/api/sign-up-process",
                    {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                    },
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                router.push("/");
            } catch (e) {
                console.log((this.errors = e.response.data.errors));
            }
        },
    },
};
</script>

<template>
    <main
        class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20"
    >
        <div class="container">
            <!-- Page heading -->
            <div class="text-center">
                <router-link to="/" class="inline-block" rel="home">
                    <img
                        src="images/logo.svg"
                        class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]"
                        alt="CutCode"
                    />
                </router-link>
            </div>

            <div
                class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple"
            >
                <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>
                <form
                    class="space-y-3"
                    action="api/sign-up-process"
                    method="POST"
                >
                    <input
                        v-model="name"
                        type="text"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="Имя и фамилия"
                    />
                    <ul
                        v-if="errors"
                        class="mt-3 text-pink text-xxs xs:text-xs"
                    >
                        <li v-for="error in errors.name">{{ error }}</li>
                    </ul>
                    <input
                        v-model="email"
                        type="email"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="E-mail"
                    />
                    <ul
                        v-if="errors"
                        class="mt-3 text-pink text-xxs xs:text-xs"
                    >
                        <li v-for="error in errors.email">{{ error }}</li>
                    </ul>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <input
                                v-model="password"
                                type="password"
                                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                                placeholder="Пароль"
                            />
                        </div>
                        <div>
                            <input
                                v-model="password_confirmation"
                                type="password"
                                class="_is-error w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                                placeholder="Повторно пароль"
                            />
                        </div>
                        <ul
                            v-if="errors"
                            class="mt-3 text-pink text-xxs xs:text-xs"
                        >
                            <li v-for="error in errors.password">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <button
                        @click.prevent="submit"
                        type="submit"
                        class="w-full btn btn-pink"
                    >
                        Зарегистрироваться
                    </button>
                </form>
                <div class="space-y-3 mt-5">
                    <div class="text-xxs md:text-xs">
                        Есть аккаунт?
                        <router-link
                            to="/login"
                            class="text-white hover:text-white/70 font-bold underline underline-offset-4"
                            >Войти</router-link
                        >
                    </div>
                </div>
                <ul
                    class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20"
                >
                    <li>
                        <router-link
                            to="/"
                            class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                            target="_blank"
                            rel="noopener"
                            >Пользовательское соглашение</router-link
                        >
                    </li>
                    <li class="hidden md:block">
                        <div class="h-full w-[2px] bg-white/20"></div>
                    </li>
                    <li>
                        <router-link
                            to="#"
                            class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                            target="_blank"
                            rel="noopener"
                            >Политика конфиденциальности</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>
