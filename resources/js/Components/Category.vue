<script>
import axios from "axios";

export default {
  emits: ["fetchProducts"],
  props: {
    categories: Array,
  },

  data() {
    return {
      categoryId: this.$store.state.filters.categoryId,
    };
  },

  watch: {
    categoryId(newCat, oldCat) {
      this.$store.commit("setFilter", { categoryId: newCat });
      this.$emit("fetchProducts", null, this.$store.state.filters);
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
        v-for="category in categories"
        @click="
          categoryId === category.id
            ? (categoryId = null)
            : (categoryId = category.id)
        "
        :key="category.id"
        :to="{ name: 'catalog' }"
        class="rounded-xl bg-card p-3 text-xxs font-semibold text-white hover:bg-pink sm:p-4 sm:text-xs lg:text-sm 2xl:p-6"
        :class="{ 'bg-pink': categoryId === category.id }"
        >{{ category.title }}</router-link
      >
    </div>
  </section>
</template>
