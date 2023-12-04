<script>
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { deleteItemById, getOrders } from "../Api/OrderApi";
import { mappedTimestamp } from "../../helpers/Date";
export default {
  components: {
    LayoutComponent,
  },
  async mounted() {
    await this.getOrders();
  },
  data() {
    return {
      orders: null,
    };
  },
  methods: {
    async getOrders() {
      try {
        const res = await getOrders();
        this.orders = res;
      } catch (err) {
        console.log(err);
      }
    },
    async deleteItem(id) {
      await deleteItemById(id);
      await this.getOrders();
    },
    mappedTimestamp: mappedTimestamp,
    goToOrderItem(order) {
      this.$router.push({
        name: "order.items",
        query: {
          timestamp: this.mappedTimestamp(order.created_at),
          status: order.status,
        },
        params: {
          id: order.id,
        },
      });
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
            <router-link
              :to="{ name: 'home' }"
              class="text-body hover:text-pink text-xs"
              >Главная</router-link
            >
          </li>
          <li><span class="text-body text-xs">Мои заказы</span></li>
        </ul>

        <section>
          <!-- Section heading -->
          <h1 class="mb-8 text-lg lg:text-[42px] font-black">Мои заказы</h1>

          <!-- Orders list -->
          <div class="w-full space-y-4 text-white text-sm text-left">
            <!-- Order item -->
            <div
              v-for="order in orders"
              class="flex flex-col lg:flex-row lg:items-center lg:justify-between px-4 md:px-6 rounded-xl md:rounded-2xl bg-card"
            >
              <div class="py-4">
                <div class="flex gap-6">
                  <!-- <div
                    class="shrink-0 overflow-hidden w-[64px] sm:w-[84px] h-[64px] sm:h-[84px] rounded-2xl"
                  >
                    <img
                      src="/images/products/1.jpg"
                      class="object-cover w-full h-full"
                      alt="Заказ №3517"
                    />
                  </div> -->
                  <div class="grow py-2">
                    <div
                      class="flex flex-col md:flex-row md:items-center gap-2"
                    >
                      <h4 class="pr-3 text-md font-bold">
                        <router-link
                          :to="{
                            name: 'order.items',
                            params: { id: order.id },
                          }"
                          class="inline-block text-white hover:text-pink"
                          >Заказ №{{ order.id }}</router-link
                        >
                      </h4>
                      <div class="px-3 py-1 rounded-md bg-purple text-xxs">
                        {{ order.status }}
                      </div>
                      <div class="px-3 py-1 rounded-md bg-white/10 text-xxs">
                        {{ mappedTimestamp(order.created_at) }}
                      </div>
                    </div>
                    <div class="mt-3 text-body text-xs">
                      На сумму: {{ order.total_price }} ₽
                    </div>
                  </div>
                </div>
              </div>
              <div class="py-4">
                <div class="flex items-center gap-4">
                  <button
                    @click="goToOrderItem(order)"
                    class="!h-14 btn btn-purple"
                  >
                    Подробнее
                  </button>
                  <button
                    @click="deleteItem(order.id)"
                    class="w-14 !h-14 !px-0 btn btn-pink"
                    title="Удалить заказ"
                  >
                    <svg
                      class="w-4 h-4"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 52 52"
                    >
                      <path
                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"
                      />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
