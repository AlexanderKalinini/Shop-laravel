<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <main
        class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20"
    >
        <div class="container">
            <!-- Page heading -->
            <div class="text-center">
                <Link href="/" class="inline-block" rel="home">
                    <img
                        src="images/logo.svg"
                        class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]"
                        alt="CutCode"
                    />
                </Link>
            </div>

            <div
                class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple"
            >
                <h1 class="mb-5 text-lg font-semibold">Регистрация</h1>
                <form
                    @submit.prevent="submit"
                    class="space-y-3"
                    action="/sign-up-process"
                    method="POST"
                >
                    <input
                        v-model="form.name"
                        name="name"
                        type="text"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="Имя и фамилия"
                        required
                    />
                    <input
                        name="email"
                        type="email"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="E-mail"
                        required
                    />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <input
                                name="password"
                                type="password"
                                class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                                placeholder="Пароль"
                                required
                            />
                        </div>
                        <div>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="_is-error w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                                placeholder="Повторно пароль"
                                required
                            />
                            <div class="mt-3 text-pink text-xxs xs:text-xs">
                                Введите пароль ещё раз
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full btn btn-pink">
                        Зарегистрироваться
                    </button>
                </form>
                <div class="space-y-3 mt-5">
                    <div class="text-xxs md:text-xs">
                        Есть аккаунт?
                        <Link
                            href="/login"
                            class="text-white hover:text-white/70 font-bold underline underline-offset-4"
                            >Войти</Link
                        >
                    </div>
                </div>
                <ul
                    class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20"
                >
                    <li>
                        <a
                            href="#"
                            class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                            target="_blank"
                            rel="noopener"
                            >Пользовательское соглашение</a
                        >
                    </li>
                    <li class="hidden md:block">
                        <div class="h-full w-[2px] bg-white/20"></div>
                    </li>
                    <li>
                        <a
                            href="#"
                            class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                            target="_blank"
                            rel="noopener"
                            >Политика конфиденциальности</a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>
