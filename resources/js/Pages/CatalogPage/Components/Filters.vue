<script>
import axios from "axios";

export default {
  async created() {
    await this.getFilters();
    this.filters.checkedBrands = this.$store.state.filters.brandsId ?? [];
  },
  data() {
    return {
      maxPrice: null,
      minPrice: null,
      brands: [],
      options: [],
      withLight: null,
      checkedColors: [],
      filters: {
        checkedBrands: [],
        options: [],
        withLight: false,
        minPrice: this.minPrice,
        maxPrice: this.maxPrice,
      },
    };
  },

  watch: {
    filters: {
      handler(newFilter) {
        this.$store.commit("setFilter", {
          brandsId: newFilter.checkedBrands,
          maxPrice: newFilter.maxPrice,
          minPrice: newFilter.minPrice,
          options: newFilter.options,
          page: null,
        });
      },
      deep: true,
    },
  },
  methods: {
    async getFilters() {
      const res = await axios.get("/api/filters");
      this.brands = res.data.brands;
      this.maxPrice = res.data.maxPrice;
      this.minPrice = res.data.minPrice;
      this.options = res.data.options;
    },

    resetFilters() {
      this.filters = {
        checkedBrands: [],
        options: [],
        withLight: false,
        minPrice: this.minPrice,
        maxPrice: this.maxPrice,
      };
    },
  },
};
</script>
<template>
  <aside class="basis-2/5 xl:basis-1/4">
    <form
      class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card"
    >
      <!-- Filter item -->
      <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цена</h5>
        <div class="flex items-center justify-between gap-3 mb-2">
          <span class="text-body text-xxs font-medium">От,₽</span>
          <span class="text-body text-xxs font-medium">До, ₽</span>
        </div>
        <div class="flex items-center gap-3">
          <input
            v-model.lazy="filters.minPrice"
            type="number"
            class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
            :placeholder="`От ${minPrice}`"
          />
          <span class="text-body text-sm font-medium">–</span>
          <input
            v-model.lazy="filters.maxPrice"
            type="number"
            class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
            :placeholder="`До ${maxPrice}`"
          />
        </div>
      </div>
      <!-- Filter item -->
      <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Бренд</h5>
        <div v-for="brand in brands" :key="brand.id" class="form-checkbox">
          <input
            v-model="filters.checkedBrands"
            type="checkbox"
            :value="`${brand.id}`"
            :id="`${brand.id}`"
          />
          <label :for="`${brand.id}`" class="form-checkbox-label">{{
            brand.title
          }}</label>
        </div>
      </div>
      <!-- Filter item -->
      <div v-for="(values, option) in options">
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{ option }}</h5>
        <div v-for="value in values" class="form-checkbox">
          <input
            v-model="filters.options"
            type="checkbox"
            :id="value"
            :value="value"
          />
          <label :for="value" class="form-checkbox-label">{{ value }}</label>
        </div>
      </div>

      <div>
        <button
          @click="resetFilters"
          type="reset"
          class="w-full !h-16 btn btn-outline"
        >
          Сбросить фильтры
        </button>
      </div>
    </form>
  </aside>
</template>
