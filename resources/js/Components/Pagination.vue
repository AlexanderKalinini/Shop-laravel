<script>
// TODO убрать пагинацию если ничего не найдено
export default {
  emits: ["fetchProducts"],
  props: {
    links: Array,
    fetchProducts: Function,
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
          @click="$emit('fetchProducts', link.label, this.$store.state.filters)"
        >
          {{ link.label }}
        </button>
      </li>
    </ul>
  </div>
</template>
