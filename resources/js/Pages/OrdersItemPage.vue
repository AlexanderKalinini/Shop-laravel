<script>
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { getOrderById } from "../Api/OrderApi";
import { total } from "../../helpers/Cart";
import { mappedTimestamp } from "../../helpers/Date";

export default {
  props: {
    id: String,
  },
  components: {
    LayoutComponent,
  },

  created() {
    this.getOrder(this.id);
  },

  data() {
    return {
      order: {},
    };
  },
  computed: {
    total() {
      return total(this.order.order_items);
    },
    mappedTimestamp() {
      return mappedTimestamp(this.order?.created_at);
    },
  },

  methods: {
    async getOrder(id) {
      try {
        const res = await getOrderById(id);
        console.log(res);
        this.order = res;
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>
<template>
  <LayoutComponent>
    <main class="py-16 lg:py-20">
      <div class="container">
        <!-- Breadcrumbs -->
        <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
          <li>
            <router-link to="/" class="text-body hover:text-pink text-xs"
              >Главная</router-link
            >
          </li>
          <li>
            <router-link to="/orders" class="text-body hover:text-pink text-xs"
              >Мои заказы</router-link
            >
          </li>
          <li>
            <span class="text-body text-xs">Заказ №{{ id }}</span>
          </li>
        </ul>

        <section>
          <!-- Section heading -->
          <div
            class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6 mb-8"
          >
            <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-black">
              Заказ №{{ order?.id }}
            </h1>
            <div class="px-6 py-3 rounded-lg bg-purple">
              {{ order?.status }}
            </div>
            <div class="px-6 py-3 rounded-lg bg-card">
              Дата заказа: {{ mappedTimestamp }}
            </div>
          </div>

          <!-- Message -->
          <div class="md:hidden py-3 px-6 rounded-lg bg-pink text-white">
            Таблицу можно пролистать вправо →
          </div>

          <!-- Adaptive table -->
          <div class="overflow-auto">
            <table
              class="min-w-full border-spacing-y-4 text-white text-sm text-left"
              style="border-collapse: separate"
            >
              <thead class="text-xs uppercase">
                <th scope="col" class="py-3 px-6">Товар</th>
                <th scope="col" class="py-3 px-6">Цена</th>
                <th scope="col" class="py-3 px-6">Количество</th>
                <th scope="col" class="py-3 px-6">Сумма</th>
              </thead>
              <tbody>
                <tr v-for="product in order?.order_items">
                  <td scope="row" class="py-4 px-6 rounded-l-2xl bg-card">
                    <div
                      class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6"
                    >
                      <div
                        class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl"
                      >
                        <img
                          :src="product?.product.thumbnail"
                          class="object-cover w-full h-full"
                          alt="SteelSeries Aerox 3 Snow"
                        />
                      </div>
                      <div class="py-3">
                        <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                          <router-link
                            :to="{
                              name: 'product',
                              params: { slug: product.product.slug },
                            }"
                            class="inline-block text-white hover:text-pink"
                            >{{ product.product.title }}</router-link
                          >
                        </h4>
                        <ul class="space-y-1 mt-2 text-xs">
                          <li
                            v-for="option in product?.option_values"
                            class="text-body"
                          >
                            {{ option.option.title + ": " + option.value }}
                          </li>
                        </ul>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 px-6 bg-card">
                    <div class="font-medium whitespace-nowrap">
                      {{ product.price }} ₽
                    </div>
                  </td>
                  <td class="py-4 px-6 bg-card">{{ product.quantity }}</td>
                  <td class="py-4 px-6 bg-card rounded-r-2xl">
                    <div class="font-medium whitespace-nowrap">
                      {{ product.price * product.quantity }} ₽
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div
            class="flex flex-col-reverse md:flex-row md:items-center md:justify-between mt-8 gap-6"
          >
            <div class="flex md:justify-end">
              <button @click="$router.go(-1)" class="btn btn-pink">
                ←&nbsp; Вернуться назад
              </button>
            </div>
            <div class="text-[32px] font-black md:text-right">
              Итого: {{ total }} ₽
            </div>
          </div>
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
