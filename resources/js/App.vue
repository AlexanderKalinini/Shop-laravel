<script>
import router from "./router/router";

export default {
  async created() {
    router.beforeEach(async (to, from, next) => {
      const notAccess = await this.notAccess(to, {
        auth: ["edit.profile", "orders", "order.items"],
        guest: [
          "login",
          "signup",
          "login.mail",
          "signup.mail",
          "lost.password",
          "password.reset",
        ],
      });
      if (notAccess) {
        next({ name: "notfound" });
      } else next();
    });
  },
  methods: {
    async notAccess(to, routes = { auth: [], guest: [] }) {
      const user = await this.$store.dispatch("fetchUser");
      const routeName = to.name;
      if (!user) {
        return routes.auth.includes(routeName);
      }
      if (user) {
        return routes.guest.includes(routeName);
      }
    },
    async guestGuard(to, routes) {},
  },
};
</script>
<template>
  <router-view></router-view>
</template>
