<script>
export default {
  props: {
    crumbs: Array,
  },
};
</script>
<template>
  <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
    <li v-for="crumb in this.crumbs">
      <router-link
        :to="{ name: crumb.routeName }"
        class="text-body hover:text-pink text-xs"
        >{{ crumb.title }}</router-link
      >
    </li>
  </ul>
</template>
