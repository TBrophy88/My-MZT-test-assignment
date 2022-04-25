<template>
  <div class="sticky top-0 z-50 w-full p-6 bg-teal-100 text-right font-bold">
    Your wallet has: {{ store.wallet }} coins
  </div>
</template>

<script>
import { useStore } from "../store/store.js";

export default {
  setup() {
    const store = useStore();
    store.initializeStore();
    return { store };
  },
};
</script>
