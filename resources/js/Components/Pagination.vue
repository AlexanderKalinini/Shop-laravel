<script>
export default {
  props: {
    links: Array,
  },

  methods: {
    setPage(page) {
      this.$store.commit("setFilter", { page: page });
    },
  },
};
</script>
<template>
  <div class="mt-12">
    <ul class="flex flex-wrap items-center justify-center gap-3">
      <li v-for="link in links">
        <button
          class="block p-3 text-sm font-black leading-none"
          :class="{
            'text-pink': link.active,
            'pointer-events-none': link.active,
          }"
          v-if="
            links.length > 3 && (Number(link.label) || link.label === '...')
          "
          @click="setPage(link.label)"
        >
          {{ link.label }}
        </button>
      </li>
    </ul>
  </div>
</template>
