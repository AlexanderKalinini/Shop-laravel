<script>
import axios from "axios";

export default {
    data() {
        return {
            email: null,
            error: null,
        };
    },
    methods: {
        async sendPass() {
            await axios.get("/sanctum/csrf-cookie");
            try {
                const res = await axios.post(
                    "/api/send-pass",
                    {
                        email: this.email,
                    },
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                console.log(res);
            } catch (err) {
                this.error = err.response.data.message;
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
                <h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>
                <form class="space-y-3">
                    <input
                        v-model="email"
                        type="email"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="E-mail"
                    />
                    <ul v-if="error" class="mt-3 text-pink text-xxs xs:text-xs">
                        {{
                            error
                        }}
                    </ul>
                    <button
                        @click.prevent="sendPass"
                        type="submit"
                        class="w-full btn btn-pink"
                    >
                        Отправить
                    </button>
                </form>
                <div class="space-y-3 mt-5">
                    <div class="text-xxs md:text-xs">
                        <router-link
                            to="sign-up-mail"
                            class="text-white hover:text-white/70 font-bold"
                            >Регистрация</router-link
                        >
                    </div>
                </div>
                <ul
                    class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20"
                >
                    <li>
                        <button
                            class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                            target="_blank"
                            rel="noopener"
                        >
                            Пользовательское соглашение
                        </button>
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
