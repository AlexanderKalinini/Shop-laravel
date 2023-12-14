<script>
import { clearCart, getCart, total } from "../../helpers/Cart";
import Breadcrumps from "../Components/Breadcrumps.vue";
import LayoutComponent from "../Layuot/LayoutComponent.vue";
import { postOrder as order, getPromoByTitle } from "../Api/OrderApi";
import { signup } from "../Api/AuthApi";
import axios from "axios";
import { getPaymentLink } from "../Api/Payment";
import router from "../router/router";

export default {
  components: {
    LayoutComponent,
    Breadcrumps,
  },

  created() {
    this.user = this.$store?.state?.user;
    this.cart = getCart();
    this.order.cart = JSON.stringify(this.cart);
    this.order.name = this.userNameSurname[0];
    this.order.surname = this.userNameSurname[1];
    this.order.email = this.user?.email;
    this.promoError = null;
  },

  data() {
    return {
      user: null,
      cart: null,
      password: null,
      password_confirmation: null,
      errors: null,
      promo: null,
      promoDeleted: null,
      promoError: null,
      quantityError: null,
      deliveryCosts: 0,
      buttonDisabled: false,
      order: {
        name: null,
        surname: null,
        phoneNumber: null,
        email: null,
        deliveryMethod: "pickup",
        paymentMethod: "card",
        cart: null,
        promo: null,
        country: "",
        city: "",
        street: "",
        totalPrice: "",
      },
      createAccount: false,
      crumbs: [
        { title: "Главная", routeName: "home" },
        { title: "Корзина покупок", routeName: "cart" },
        { title: "Оформление заказа", routeName: null },
      ],
    };
  },
  computed: {
    userNameSurname() {
      return this.user?.name?.split(" ") || [];
    },

    totalCart() {
      return total(this?.cart);
    },

    total() {
      return this.totalCart - this.countDiscount + this.deliveryCosts;
    },

    countDiscount() {
      return Math.round(total(this?.cart) * this.order?.promo?.discount) || 0;
    },
  },
  methods: {
    async getPromo() {
      this.promoDeleted = null;
      this.promoError = null;
      if (!(this.promo = this.$refs.promoInput.value)) return;
      try {
        this.order.promo = await getPromoByTitle(this.promo);
      } catch (err) {
        this.promoError = err.response.statusText;
      }
    },
    disableButton() {
      this.buttonDisabled = true;
      setTimeout(() => {
        this.buttonDisabled = false;
      }, 3000);
    },
    async paymentRedirect(orderId) {
      const res = await getPaymentLink({
        price: +this.total,
        order_id: +orderId,
      });
      window.location.href = res.data;
    },

    async signup() {
      await axios.get("/sanctum/csrf-cookie");
      try {
        const res = await signup({
          name: this.order.name + " " + this.order.surname,
          email: this.order.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        });

        return res;
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    },

    async postOrder() {
      this.disableButton();
      if (this.createAccount) {
        let res = await this.signup();
        if (!res) return;
        this.$store.dispatch("fetchUser");
      }

      await axios.get("/sanctum/csrf-cookie");
      try {
        this.order.totalPrice = this.totalCart - this.countDiscount;
        const res = await order(this.order);
        if (this.order.paymentMethod === "card") {
          await this.paymentRedirect(res.data.id);
        } else {
          router.push({
            name: "order.success",
            params: { id: res.data.id },
          });
        }
        clearCart();
      } catch (err) {
        this.errors = err?.response?.data?.errors;
        if (
          err?.response?.data?.exception ===
          "App\\Exceptions\\QuantityException"
        ) {
          this.quantityError = err.response?.data?.message;
        }
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
        <Breadcrumps :crumbs="crumbs" />

        <section>
          <!-- Section heading -->
          <h1 class="mb-8 text-lg lg:text-[42px] font-black">
            Оформление заказа
          </h1>

          <form class="grid xl:grid-cols-3 items-start gap-6 2xl:gap-8 mt-12">
            <!-- Contact information -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
              <h3 class="mb-6 text-md 2xl:text-lg font-bold">
                Контактная информация
              </h3>
              <div class="space-y-3">
                <input
                  @input="order.name = $event.target.value"
                  type="text"
                  class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                  placeholder="Имя"
                  :value="userNameSurname[0] || order.name"
                />
                <div
                  v-if="errors?.name"
                  class="mt-3 text-pink text-xxs xs:text-xs"
                >
                  {{ errors?.name.join(" ") }}
                </div>
                <input
                  @input="order.surname = $event.target.value"
                  type="text"
                  class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                  placeholder="Фамилия"
                  :value="userNameSurname[1] || order.surname"
                />
                <div
                  v-if="errors?.surname"
                  class="mt-3 text-pink text-xxs xs:text-xs"
                >
                  {{ errors?.surname.join(" ") }}
                </div>
                <input
                  @input="order.phoneNumber = $event.target.value"
                  type="number"
                  class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                  placeholder="Номер телефона"
                />
                <div
                  v-if="errors?.phoneNumber"
                  class="mt-3 text-pink text-xxs xs:text-xs"
                >
                  {{ errors?.phonemail.join(" ") }}
                </div>
                <input
                  @input="order.email = $event.target.value"
                  type="email"
                  class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                  placeholder="E-mail"
                  :value="user?.email || order.email"
                />
                <div
                  v-if="errors?.email"
                  class="mt-3 text-pink text-xxs xs:text-xs"
                >
                  {{ errors?.email.join(" ") }}
                </div>
                <div v-if="!user">
                  <div class="py-3 text-body">
                    Вы можете создать аккаунт после оформления заказа
                  </div>
                  <div class="form-checkbox">
                    <input
                      v-model="createAccount"
                      type="checkbox"
                      id="checkout-create-account"
                    />
                    <label
                      for="checkout-create-account"
                      class="form-checkbox-label"
                      >Зарегистрировать аккаунт</label
                    >
                  </div>
                  <transition
                    enter-from-class="opacity-0"
                    enter-active-class="ease-out duration-300"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-150"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                    class="mt-4 space-y-3"
                  >
                    <div v-if="createAccount">
                      <input
                        v-model="password"
                        type="password"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="Придумайте пароль"
                      />
                      <div
                        v-if="errors?.password"
                        class="mt-3 text-pink text-xxs xs:text-xs"
                      >
                        {{ errors?.password.join(" ") }}
                      </div>
                      <input
                        v-model="password_confirmation"
                        type="password"
                        class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                        placeholder="Повторите пароль"
                      />
                      <div
                        v-if="errors?.password_confirmation"
                        class="mt-3 text-pink text-xxs xs:text-xs"
                      >
                        {{ errors?.password.join(" ") }}
                      </div>
                    </div>
                  </transition>
                </div>
              </div>
            </div>

            <!-- Shipping & Payment -->
            <div class="space-y-6 2xl:space-y-8">
              <!-- Shipping-->
              <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">
                  Способ доставки
                </h3>
                <div class="space-y-5">
                  <div class="form-radio">
                    <input
                      @click="deliveryCosts = 0"
                      type="radio"
                      v-model="order.deliveryMethod"
                      id="delivery-method-pickup"
                      value="pickup"
                    />
                    <label for="delivery-method-pickup" class="form-radio-label"
                      >Самовывоз</label
                    >
                  </div>

                  <div>
                    <div class="form-radio">
                      <input
                        type="radio"
                        @click="deliveryCosts = 1000"
                        v-model="order.deliveryMethod"
                        id="delivery-method-address"
                        value="delivery"
                      />
                      <label
                        for="delivery-method-address"
                        class="form-radio-label"
                        >Адресная доставка</label
                      >
                    </div>

                    <transition
                      enter-from-class="opacity-0"
                      enter-active-class="ease-out duration-300"
                      enter-to-class="opacity-100"
                      leave-active-class="ease-in duration-150"
                      leave-from-class="opacity-100"
                      leave-to-class="opacity-0"
                    >
                      <div
                        class="space-y-3"
                        v-if="order.deliveryMethod === 'delivery'"
                      >
                        <input
                          @input="order.country = $event.target.value"
                          type="text"
                          class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                          placeholder="Страна"
                          :value="order.country"
                        />
                        <div
                          v-if="errors?.country"
                          class="mt-3 text-pink text-xxs xs:text-xs"
                        >
                          {{ errors?.country.join(" ") }}
                        </div>
                        <input
                          @input="order.city = $event.target.value"
                          type="text"
                          class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                          placeholder="Город"
                          :value="order.city"
                        />
                        <div
                          v-if="errors?.city"
                          class="mt-3 text-pink text-xxs xs:text-xs"
                        >
                          {{ errors?.city.join(" ") }}
                        </div>
                        <input
                          @input="order.street = $event.target.value"
                          type="text"
                          class="w-full h-16 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                          placeholder="Адрес"
                          :value="order.street"
                        />
                        <div
                          v-if="errors?.street"
                          class="mt-3 text-pink text-xxs xs:text-xs"
                        >
                          {{ errors?.street.join(" ") }}
                        </div>
                      </div>
                    </transition>
                  </div>
                </div>
              </div>

              <!-- Payment-->
              <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Метод оплаты</h3>
                <div class="space-y-5">
                  <div class="form-radio">
                    <input
                      type="radio"
                      v-model="order.paymentMethod"
                      id="payment-method-1"
                      value="cash"
                    />
                    <label for="payment-method-1" class="form-radio-label"
                      >Наличными при получении</label
                    >
                  </div>
                  <div class="form-radio">
                    <input
                      type="radio"
                      v-model="order.paymentMethod"
                      id="payment-method-2"
                      value="card"
                    />
                    <label for="payment-method-2" class="form-radio-label"
                      >Онлайн оплата</label
                    >
                  </div>
                </div>
              </div>
            </div>

            <!-- Checkout -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
              <h3 class="mb-6 text-md 2xl:text-lg font-bold">Заказ</h3>
              <table
                class="w-full border-spacing-y-3 text-body text-xxs text-left"
                style="border-collapse: separate"
              >
                <thead class="text-[12px] text-body uppercase">
                  <th scope="col" class="pb-2 border-b border-body/60">
                    Товар
                  </th>
                  <th scope="col" class="px-2 pb-2 border-b border-body/60">
                    К-во
                  </th>
                  <th scope="col" class="px-2 pb-2 border-b border-body/60">
                    Сумма
                  </th>
                </thead>
                <tbody>
                  <tr v-for="product in cart">
                    <td scope="row" class="pb-3 border-b border-body/10">
                      <h4 class="font-bold">
                        <router-link
                          :to="{
                            name: 'product',
                            params: { slug: product.slug },
                          }"
                          class="inline-block text-white hover:text-pink break-words pr-3"
                          >{{ product.title }}</router-link
                        >
                      </h4>
                      <ul>
                        <li
                          v-for="option in Object.entries(product.options)"
                          class="text-body"
                        >
                          {{ option[0] + ": " + option[1] }}
                        </li>
                      </ul>
                    </td>
                    <td
                      class="px-2 pb-3 border-b border-body/20 whitespace-nowrap"
                    >
                      {{ product.quantity }}
                    </td>
                    <td
                      class="px-2 pb-3 border-b border-body/20 whitespace-nowrap"
                    >
                      {{ product.price * product.quantity }} ₽
                    </td>
                  </tr>
                </tbody>
              </table>
              <div
                v-if="quantityError"
                class="mt-3 text-pink text-xxs xs:text-xs"
              >
                {{ quantityError }}
              </div>
              <div class="text-xs font-semibold text-right">
                Всего: {{ totalCart }} ₽
              </div>

              <div class="mt-8 space-y-8">
                <!-- Promocode -->
                <div class="space-y-4">
                  <div class="flex gap-3">
                    <input
                      ref="promoInput"
                      type="text"
                      class="grow w-full h-[56px] px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                      placeholder="Промокод (fifty)"
                    />
                    <button
                      @click.prevent="getPromo()"
                      type="submit"
                      class="shrink-0 w-14 !h-[56px] !px-0 btn btn-purple"
                    >
                      →
                    </button>
                  </div>
                  <div class="space-y-3">
                    <div
                      v-if="order.promo"
                      class="px-4 py-3 rounded-lg bg-[#137d3d] text-xs"
                    >
                      Промокод
                      <button
                        @click="
                          (promoDeleted = order.promo.title),
                            (order.promo = null)
                        "
                        class="mx-2 py-0.5 px-1.5 rounded-md border-dashed border-2 text-white hover:text-white/70 text-xs"
                        title="Удалить промокод"
                      >
                        &times; {{ order.promo.title }}
                      </button>
                      успешно добавлен.
                    </div>
                    <div
                      v-if="promoDeleted"
                      class="px-4 py-3 rounded-lg bg-[#b91414] text-xs"
                    >
                      Промокод <b>{{ promoDeleted }}</b> удалён.
                    </div>
                    <div
                      v-if="promoError === 'Not Found' && promo"
                      class="px-4 py-3 rounded-lg bg-[#b91414] text-xs"
                    >
                      Промокод <b>{{ promo }}</b> не найден.
                    </div>
                  </div>
                </div>

                <!-- Summary -->
                <table class="w-full text-left">
                  <tbody>
                    <tr v-if="deliveryCosts">
                      <th scope="row" class="pb-2 text-xs font-medium">
                        Доставка:
                      </th>
                      <td class="pb-2 text-xs">{{ deliveryCosts }}</td>
                    </tr>
                    <tr v-if="order.promo">
                      <th scope="row" class="pb-2 text-xs font-medium">
                        Промокод:
                      </th>
                      <td class="pb-2 text-xs">
                        {{ countDiscount }}
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-md 2xl:text-lg font-black">
                        Итого:
                      </th>
                      <td class="text-md 2xl:text-lg font-black">
                        {{ total }} ₽
                      </td>
                    </tr>
                  </tbody>
                </table>

                <!-- Process to checkout -->
                <button
                  :disabled="buttonDisabled"
                  @click.prevent="postOrder()"
                  type="submit"
                  class="w-full btn btn-pink"
                >
                  Оформить заказ
                </button>
              </div>
            </div>
          </form>
        </section>
      </div>
    </main>
  </LayoutComponent>
</template>
