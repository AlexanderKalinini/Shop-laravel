<script>
import FooterModals from "./FooterModals.vue";
export default {
  components: {
    FooterModals,
  },
};
</script>
<template>
  <footer class="footer py-8 sm:py-12 xl:py-16">
    <div class="container">
      <div class="flex flex-wrap items-center lg:flex-nowrap">
        <div
          class="footer-logo order-0 shrink-0 basis-full text-center sm:basis-1/2 sm:text-left lg:basis-1/3"
        >
          <router-link :to="{ name: 'home' }" class="inline-block" rel="home">
            <img
              src="/images/logo.svg"
              class="h-[38px] w-[155px]"
              alt="CutCode"
            />
          </router-link>
        </div>
        <!-- /.footer-logo -->
        <div
          class="footer-copyright order-2 mt-8 basis-full lg:order-1 lg:mt-0 lg:basis-1/3"
        >
          <div class="text-center text-xxs text-[#999] xs:text-xs sm:text-sm">
            Shop, 2023 © Все права защищены.
          </div>
        </div>
        <!-- /.footer-copyright -->
        <div
          class="footer-social order-1 mt-8 basis-full sm:mt-0 sm:basis-1/2 lg:order-2 lg:basis-1/3"
        >
          <div
            class="flex flex-wrap items-center justify-center space-x-6 sm:justify-end"
          >
            <a
              href="https://www.youtube.com/"
              class="inline-flex items-center text-white hover:text-pink"
              target="_blank"
              rel="nofollow noopener"
            >
              <img
                class="h-5 lg:h-6"
                src="/images/icons/youtube.svg"
                alt="YouTube"
              />
              <span class="ml-2 text-xxs font-semibold lg:ml-3">YouTube</span>
            </a>
            <a
              href="https://web.telegram.org"
              class="inline-flex items-center text-white hover:text-pink"
              target="_blank"
              rel="nofollow noopener"
            >
              <img
                class="h-5 lg:h-6"
                src="/images/icons/telegram.svg"
                alt="Telegram"
              />
              <span class="ml-2 text-xxs font-semibold lg:ml-3">Telegram</span>
            </a>
          </div>
        </div>
        <!-- /.footer-social -->
      </div>
    </div>
    <!-- /.container -->
  </footer>
  <FooterModals />
</template>
