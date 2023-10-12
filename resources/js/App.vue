<script>
export default {
    mounted() {
        this.$store.dispatch("fetchUser");
    },
};
</script>
<template>
    <router-view></router-view>
</template>
