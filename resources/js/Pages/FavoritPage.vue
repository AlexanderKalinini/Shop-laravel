<script>
import Favorit from "../../helpers/Favorit";
import Breadcrumps from "../Components/Breadcrumps.vue";
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import ProductsInline from "./CatalogPage/Components/ProductsInline.vue";

export default {
  components: {
    LayoutComponent,
    ProductsInline,
    Breadcrumps,
  },
  created() {
    this.favorits = new Favorit();
  },
  data() {
    return {
      favorits: null,
      crumbs: [
        {
          title: "Главная",
          routeName: "home",
        },
        {
          title: "Избранное",
          routeName: null,
        },
      ],
    };
  },
  methods: {
    onUpdateProducts() {
      this.favorits = new Favorit();
    },
  },
};
</script>
<template>
  <LayoutComponent>
    <main class="py-16 lg:py-20">
      <div class="container">
        <Breadcrumps :crumbs="crumbs" />
        <section>
          <h2 class="text-lg mb-8 lg:text-[42px] font-black">Избранное</h2>
          <ProductsInline
            @update-products="onUpdateProducts"
            :products="favorits.getFavorits()"
          />
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
