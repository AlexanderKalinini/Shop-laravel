<script>
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { fetchProducts } from "../Api/ProductApi";
import { mapState } from "vuex";
import Pagination from "../Components/Pagination.vue";
import ProductsInline from "./CatalogPage/Components/ProductsInline.vue";
import Breadcrumbs from "../Components/Breadcrumps.vue";
import { onUpdated } from "vue";

export default {
  components: {
    LayoutComponent,
    ProductsInline,
    Pagination,
    Breadcrumbs,
  },
  data() {
    return {
      productsData: [],
      title: "",
    };
  },
  async created() {
    this.productsData = await fetchProducts(this.$store.state.filters);
  },

  computed: {
    ...mapState({
      filters: (state) => state.filters,
    }),
    titleUpdated() {
      if (this.filters?.title) {
        this.title = this.filters?.title;
        return this.title;
      } else {
        return this.title;
      }
    },

    crumbs() {
      return [
        { title: "Главная", routeName: "home" },
        { title: "Каталог", routeName: "catalog" },
        { title: "Поиск", routeName: null },
      ];
    },
  },
  watch: {
    filters: {
      async handler(newFilter) {
        if (!newFilter.title) return;
        this.productsData = await fetchProducts(newFilter);
      },
      deep: true,
    },
  },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      const { title } = vm.$store.state.filters;
      if (!title) {
        vm.$router.push({ name: "notfound" });
      }
    });
  },
};
</script>
<template>
  <LayoutComponent>
    <main class="py-16 lg:py-20">
      <div class="container">
        <Breadcrumbs :crumbs="crumbs" />
        <section>
          <!-- Section heading -->
          <h2 class="text-lg mb-10 lg:text-[42px] font-black">
            Поиск по запросу: {{ titleUpdated }}
          </h2>

          <!-- Products list -->
          <ProductsInline :products="productsData?.data"></ProductsInline>
          <Pagination :links="productsData?.meta?.links" />
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
