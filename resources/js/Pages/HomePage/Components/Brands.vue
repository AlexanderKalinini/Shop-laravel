<script>
import axios from "axios";
export default {
  data() {
    return {
      brands: [],
    };
  },
  created() {
    this.loadBrands();
  },
  methods: {
    async loadBrands() {
      await axios.get("/sanctum/csrf-cookie");
      try {
        this.brands = await axios.get("/api/brand-show");
      } catch (err) {
        console.log(err.message);
      }
    },
    setFilter(id) {
      this.$store.commit("setFilter", { brandsId: [id] });
    },
  },
};
</script>
<template>
  <div
    class="mt-12 grid grid-cols-2 gap-4 md:grid-cols-3 md:gap-8 2xl:grid-cols-6"
  >
    <router-link
      v-for="(brand, index) in brands.data"
      :key="brand.id"
      :to="{ name: 'catalog' }"
      @click="setFilter(brand.id)"
      class="rounded-xl bg-card p-6 hover:bg-card/60"
    >
      <div class="h-12 md:h-16">
        <img
          :src="'images/brands/' + ++index + '.png'"
          class="h-full w-full object-contain"
          alt="Steelseries"
        />
      </div>
      <div class="mt-8 text-center text-xs font-semibold sm:text-sm lg:text-md">
        {{ brand.title }}
      </div>
    </router-link>
  </div>
</template>
