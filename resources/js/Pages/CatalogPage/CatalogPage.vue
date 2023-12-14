<script>
import axios from "axios";
import Category from "../../Components/Category.vue";
import Pagination from "../../Components/Pagination.vue";
import LayoutComponent from "../../Layuot/LayoutComponent.vue";
import Filters from "./Components/Filters.vue";
import Breadcrumps from "../../Components/Breadcrumps.vue";
import ProductsInline from "./Components/ProductsInline.vue";
import ProductsTile from "./Components/ProductsTile.vue";
import { mapState } from "vuex";
import { fetchProducts } from "../../Api/ProductApi";

export default {
  components: {
    LayoutComponent,
    Category,
    Pagination,
    Filters,
    Breadcrumps,
    ProductsInline,
    ProductsTile,
  },

  async created() {
    this.$store.commit("setFilter", { title: null });
    this.productsData = await fetchProducts(this.$store.state.filters);
  },

  data() {
    return {
      productsData: {},
      select: "default",
      componentName: "ProductsTile",
    };
  },
  computed: {
    ...mapState({
      filters: (state) => state.filters,
    }),

    crumbs() {
      return [
        { title: "Главная", routeName: "home" },
        { title: "Каталог", routeName: "catalog" },
        { title: this.filters?.category?.title, routeName: null },
      ];
    },
  },

  watch: {
    async select(newSel, oldSel) {
      this.$store.commit("setFilter", { select: newSel, page: null });
      await fetchProducts(this.$store.state.filters);
    },

    filters: {
      async handler(newFilter) {
        this.productsData = await fetchProducts({ ...newFilter, title: null });
      },
      deep: true,
    },
  },
};
</script>
<template>
  <LayoutComponent>
    <main class="py-16 lg:py-20">
      <div class="container">
        <!-- Breadcrumbs -->
        <Breadcrumps :crumbs="crumbs" />

        <Category />
        <section class="mt-16 lg:mt-24">
          <!-- Section heading -->
          <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

          <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">
            <Filters />

            <div class="basis-auto xl:basis-3/4">
              <!-- Sort by -->
              <div
                class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8"
              >
                <div class="flex items-center gap-4">
                  <div class="flex items-center gap-2">
                    <button
                      @click="componentName = 'ProductsTile'"
                      :class="{ 'bg-pink': componentName === 'ProductsTile' }"
                      class="inline-flex items-center justify-center w-10 h-10 rounded-md bg-card text-white hover:text-pink"
                    >
                      <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 52 52"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M2.6 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 49.4V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM31.2 0h18.2A2.6 2.6 0 0 1 52 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V2.6A2.6 2.6 0 0 1 31.2 0Zm15.6 18.2v-13h-13v13h13ZM31.2 28.6h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H31.2a2.6 2.6 0 0 1-2.6-2.6V31.2a2.6 2.6 0 0 1 2.6-2.6Zm15.6 18.2v-13h-13v13h13ZM2.6 0h18.2a2.6 2.6 0 0 1 2.6 2.6v18.2a2.6 2.6 0 0 1-2.6 2.6H2.6A2.6 2.6 0 0 1 0 20.8V2.6A2.6 2.6 0 0 1 2.6 0Zm15.6 18.2v-13h-13v13h13Z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </button>
                    <button
                      @click="componentName = 'ProductsInline'"
                      :class="{ 'bg-pink': componentName === 'ProductsInline' }"
                      class="inline-flex items-center justify-center w-10 h-10 rounded-md bg-card text-white hover:text-pink"
                    >
                      <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 52 52"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M7.224 4.875v4.694h37.555V4.875H7.224ZM4.877.181a2.347 2.347 0 0 0-2.348 2.347v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.39A2.347 2.347 0 0 0 47.127.182H4.877Zm2.347 23.472v4.694h37.555v-4.694H7.224Zm-2.347-4.695a2.347 2.347 0 0 0-2.348 2.348v9.389a2.347 2.347 0 0 0 2.348 2.347h42.25a2.347 2.347 0 0 0 2.347-2.348v-9.388a2.347 2.347 0 0 0-2.347-2.348H4.877ZM7.224 42.43v4.695h37.555v-4.694H7.224Zm-2.347-4.694a2.347 2.347 0 0 0-2.348 2.347v9.39a2.347 2.347 0 0 0 2.348 2.346h42.25a2.347 2.347 0 0 0 2.347-2.347v-9.389a2.347 2.347 0 0 0-2.347-2.347H4.877Z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </button>
                  </div>
                  <div class="text-body text-xxs sm:text-xs">
                    Найдено: {{ productsData?.meta?.total }}
                  </div>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                  <span class="text-body text-xxs sm:text-xs"
                    >Сортировать:</span
                  >
                  <form>
                    <select
                      v-model="select"
                      class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xxs sm:text-xs shadow-transparent outline-0 transition"
                    >
                      <option value="default" class="text-dark">
                        по умолчанию
                      </option>
                      <option value="cheap" class="text-dark">
                        от дешевых к дорогим
                      </option>
                      <option value="expensive" class="text-dark">
                        от дорогих к дешевым
                      </option>
                      <option value="title" class="text-dark">
                        по наименованию
                      </option>
                    </select>
                  </form>
                </div>
              </div>
              <component
                :is="componentName"
                :products="productsData?.data"
              ></component>
              <Pagination :links="productsData?.meta?.links" />
            </div>
          </div>
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
