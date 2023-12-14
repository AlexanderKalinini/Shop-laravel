<script>
export default {
  props: {
    crumbs: Array,
  },

  computed: {
    compCrumbs() {
      return this.crumbs.filter((el) => el.title !== undefined);
    },
  },

  methods: {
    resetCategory(crumb) {
      if (crumb?.title === "Каталог") {
        this.$store.commit("setFilter", { category: "", page: null });
      }
    },
  },
};
</script>
<template>
  <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
    <li v-for="(crumb, index) in this.compCrumbs">
      <router-link
        v-if="index !== this.compCrumbs.length - 1"
        @click="resetCategory(crumb)"
        :to="{ name: crumb.routeName }"
        class="text-body hover:text-pink text-xs"
        >{{ crumb.title }}</router-link
      >
      <span v-else class="text-body text-xs">{{ crumb.title }}</span>
    </li>
  </ul>
</template>
