<script>
import axios from "axios";

export default {
    created() {
        this.loadCategory();
    },
    data() {
        return {
            categories: [],
        };
    },
    methods: {
        async loadCategory() {
            await axios.get("/sanctum/csrf-cookie");
            try {
                this.categories = await axios.get("/api/category-show");
            } catch (err) {
                console.log(err.message);
            }
        },
    },
};
</script>

<template>
    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg font-black lg:text-[42px]">Категории</h2>

        <!-- Categories -->
        <div
            class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 md:gap-5 xl:grid-cols-5"
        >
            <router-link
                v-for="category in categories.data"
                :key="category.id"
                :to="{ name: 'catalog.tile' }"
                class="rounded-xl bg-card p-3 text-xxs font-semibold text-white hover:bg-pink sm:p-4 sm:text-xs lg:text-sm 2xl:p-6"
                >{{ category.title }}</router-link
            >
        </div>
    </section>
</template>
