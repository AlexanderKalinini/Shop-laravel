<script>
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { getOrderById } from "../Api/OrderApi";
import { total, totalDiscount } from "../../helpers/Cart";
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
    totalCart() {
      return total(this.order.order_items);
    },

    totalDiscount() {
      return totalDiscount(this.order.order_items);
    },

    mappedTimestamp() {
      return mappedTimestamp(this.order?.created_at);
    },
  },

  methods: {
    async getOrder(id) {
      try {
        const res = await getOrderById(id);

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
            <span class="text-body text-xs"
              >Заказ №{{ id }} успешно оформлен</span
            >
          </li>
        </ul>

        <section>
          <!-- Section heading -->
          <div
            class="flex flex-col 2xl:flex-row 2xl:items-center gap-3 md:gap-6 mb-8"
          >
            <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-black">
              Заказ №{{ order?.id }} успешно оформлен
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="px-6 py-3 rounded-lg bg-purple">
                Статус {{ order?.status }}
              </div>
              <div class="px-6 py-3 rounded-lg bg-card">
                Дата заказа: {{ mappedTimestamp }}
              </div>
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
                      {{ product.price * product.quantity }}
                      ₽
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Summary -->
          <div class="mt-12">
            <table class="w-full text-left">
              <tbody>
                <tr>
                  <th scope="row" class="pb-2 text-xs font-medium">
                    Имя и фамилия:
                  </th>
                  <td class="pb-2 text-xs">
                    {{ order?.name + " " + order?.surname }}
                  </td>
                </tr>
                <tr v-if="order?.phone_number">
                  <th scope="row" class="pb-2 text-xs font-medium">
                    Номер телефона:
                  </th>
                  <td class="pb-2 text-xs">{{ order?.phone_number }}</td>
                </tr>
                <tr>
                  <th scope="row" class="pb-2 text-xs font-medium">E-mail:</th>
                  <td class="pb-2 text-xs">{{ order?.email }}</td>
                </tr>
                <tr>
                  <th scope="row" class="pb-2 text-xs font-medium">
                    Способ доставки:
                  </th>
                  <td
                    v-if="order.delivery_method === 'delivery'"
                    class="pb-2 text-xs"
                  >
                    Адресная доставка:
                    {{ `${order.country} ${order.city} ${order.street}` }}
                  </td>
                  <td
                    v-if="order.delivery_method === 'pickup'"
                    class="pb-2 text-xs"
                  >
                    Самовывоз
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="pb-2 text-xs font-medium">
                    Метод оплаты:
                  </th>
                  <td
                    v-if="order.payment_method === 'cash'"
                    class="pb-2 text-xs"
                  >
                    Наличными
                  </td>
                  <td
                    v-if="order.payment_method === 'card'"
                    class="pb-2 text-xs"
                  >
                    Кредитной картой
                  </td>
                </tr>
                <tr v-if="totalDiscount">
                  <th scope="row" class="pb-2 text-xs font-medium">
                    Промокод:
                  </th>
                  <td class="pb-2 text-xs">{{ totalDiscount }} ₽</td>
                </tr>
                <tr>
                  <th scope="row" class="text-md 2xl:text-lg font-black">
                    Итого:
                  </th>
                  <td class="text-md 2xl:text-lg font-black">
                    {{ totalCart - totalDiscount }} ₽
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="flex flex-wrap gap-4 mt-8">
              <router-link :to="{ name: 'catalog' }" class="btn btn-pink"
                >←&nbsp; За покупками</router-link
              >
              <router-link :to="{ name: 'orders' }" class="btn btn-purple"
                >Мои заказы</router-link
              >
            </div>
          </div>
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
