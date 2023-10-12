<script>
import TheFooter from "../Components/TheFooter.vue";
import TheHeader from "../Components/TheHeader.vue";
export default {
    components: {
        TheFooter,
        TheHeader,
    },
};
</script>
<template>
    <TheHeader />
    <slot></slot>
    <TheFooter />
</template>
