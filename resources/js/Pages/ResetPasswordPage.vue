<script>
import axios from "axios";
import router from "../router/router";

export default {
  props: {
    token: String,
    email: String,
  },
  data() {
    return {
      password: null,
      password_confirmation: null,
      errorMessage: null,
    };
  },
  methods: {
    async resetPassword() {
      await axios.get("/sanctum/csrf-cookie");
      try {
        const res = await axios.post(
          "/api/reset-password",
          {
            token: this.token,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          },
          {
            headers: {
              "Content-Type": "multipart/form-data",
              Accept: "application/json",
            },
          }
        );

        router.push("/login-mail");
      } catch (err) {
        this.errorMessage = err?.response?.data;
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
        <h1 class="mb-5 text-lg font-semibold">Введите новый пароль</h1>
        <form class="space-y-3">
          <!-- <input
                        v-model="email"
                        type="email"
                        class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                        placeholder="E-mail"
                    /> -->
          <input
            v-model="password"
            type="password"
            class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
            placeholder="Новый пароль"
          />
          <input
            v-model="password_confirmation"
            type="password"
            class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
            placeholder="Подтверждение пароля"
          />
          <div v-if="errorMessage" class="mt-3 text-pink text-xxs xs:text-xs">
            {{ errorMessage }}
          </div>
          <button
            @click.prevent="resetPassword"
            type="submit"
            class="w-full btn btn-pink"
          >
            Сохранить пароль
          </button>
        </form>
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
              to="/"
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
