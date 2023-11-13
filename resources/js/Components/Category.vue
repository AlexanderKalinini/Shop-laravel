<script>
import { loadCategoriesForHomePage } from "../Api/CategoryApi.js";
import { loadCategories } from "../Api/CategoryApi.js";

export default {
  props: {
    home: Boolean,
  },
  async created() {
    if (this.home) {
      this.categories = await loadCategoriesForHomePage();
    } else {
      this.categories = await loadCategories();
    }
  },

  data() {
    return {
      categories: [],
      category: this.$store.state.filters.category,
    };
  },
  computed: {
    storeCategory() {
      return this.$store.state.filters.category;
    },
  },
  watch: {
    category(newCat, old) {
      this.$store.commit("setFilter", { category: newCat, page: null });
    },

    storeCategory(newCat, oldCat) {
      this.category = newCat;
    },
  },
};
</script>

<template>
  <section class="mt-16 lg:mt-24">
    <!-- Section heading -->
    <h2 class="text-lg font-black lg:text-[42px]">Категории</h2>

    <!-- Categories -->
    <div
      class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 md:gap-5 xl:grid-cols-5"
    >
      <router-link
        v-for="item in categories"
        @click="category === item ? (category = null) : (category = item)"
        :key="item.id"
        :to="{ name: 'catalog' }"
        class="rounded-xl bg-card p-3 text-xxs font-semibold text-white hover:bg-pink sm:p-4 sm:text-xs lg:text-sm 2xl:p-6"
        :class="{
          'bg-pink': category?.id === item?.id,
        }"
        >{{ item.title }}</router-link
      >
    </div>
  </section>
</template>
