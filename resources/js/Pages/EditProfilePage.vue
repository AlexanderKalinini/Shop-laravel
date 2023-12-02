<script>
import axios from "axios";
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { editProfile } from "../Api/AuthApi";
import router from "../router/router";

export default {
  components: {
    LayoutComponent,
  },
  created() {
    this.user = this.$store.state.user;
  },
  data() {
    return {
      name: null,
      error: null,
      userData: {
        email: null,
        password: null,
        password_confirmation: null,
        user: null,
      },
    };
  },
  methods: {
    async editProfile() {
      await axios.get("/sanctum/csrf-cookie");
      try {
        await editProfile(this.userData);
        this.$store.dispatch("fetchUser");
        router.push({ name: "home" });
      } catch (err) {
        this.error = err.response.data.message;
      }
    },
  },
};
</script>
<template>
  <main class="py-16 lg:py-20">
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
    <div class="container">
      <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">
          Редактировать профиль
        </h1>

        <div
          class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple"
        >
          <form class="space-y-3">
            <input
              @input="userData.name = $event.target.value"
              type="text"
              class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
              :value="user.name"
              placeholder="Имя и фамилия"
            />
            <input
              @input="userData.email = $event.target.value"
              type="email"
              class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
              :value="user.email"
              placeholder="E-mail"
              required
            />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div>
                <input
                  v-model="userData.password"
                  type="password"
                  class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                  placeholder="Пароль"
                  required
                />
              </div>
              <div>
                <input
                  v-model="userData.password_confirmation"
                  class="_is-error w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                  placeholder="Повторно пароль"
                  required
                />
              </div>
            </div>
            <div v-if="error" class="mt-3 text-pink text-xxs xs:text-xs">
              {{ error }}
            </div>
            <button
              @click.prevent="editProfile()"
              type="submit"
              class="w-full btn btn-pink"
            >
              Сохранить
            </button>
          </form>
        </div>
      </section>
    </div>
  </main>
</template>
