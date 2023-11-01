<script>
import axios from "axios";

export default {
  emits: ["fetchProducts"],

  created() {
    this.getFilters();
  },
  data() {
    return {
      maxPrice: null,
      minPrice: null,
      brands: [],
      withLight: null,
      checkedColors: [],
      filters: {
        checkedBrands: [],
        checkedColors: [],
        withLight: false,
        minPrice: this.minPrice,
        maxPrice: this.maxPrice,
      },
    };
  },

  watch: {
    filters: {
      handler(newFilter) {
        console.log("filter", newFilter);
        this.$store.commit("setFilter", {
          brandsId: newFilter.checkedBrands,
          maxPrice: newFilter.maxPrice,
          minPrice: newFilter.minPrice,
        });
        this.$emit("fetchProducts", null, this.$store.state.filters);
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
    },
    resetFilters() {
      this.filters = {
        checkedBrands: [],
        checkedColors: [],
        withLight: false,
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
      <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цвет</h5>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-9" />
          <label for="filters-item-9" class="form-checkbox-label">Белый</label>
        </div>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-10" />
          <label for="filters-item-10" class="form-checkbox-label"
            >Чёрный</label
          >
        </div>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-11" />
          <label for="filters-item-11" class="form-checkbox-label"
            >Желтый</label
          >
        </div>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-12" />
          <label for="filters-item-12" class="form-checkbox-label"
            >Розовый</label
          >
        </div>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-13" />
          <label for="filters-item-13" class="form-checkbox-label"
            >Красный</label
          >
        </div>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-14" />
          <label for="filters-item-14" class="form-checkbox-label">Серый</label>
        </div>
      </div>
      <!-- Filter item -->
      <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Подсветка</h5>
        <div class="form-checkbox">
          <input type="checkbox" id="filters-item-7" />
          <label for="filters-item-7" class="form-checkbox-label"
            >Без подсветки</label
          >
        </div>
        <div class="form-checkbox">
          <input
            v-bind="withLight"
            value="true"
            type="checkbox"
            id="filters-item-8"
          />
          <label for="filters-item-8" class="form-checkbox-label"
            >З подсветкой</label
          >
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
