<template>
  <div>
    <div class="p-10">
      <h1 class="text-4xl font-bold">Candidates</h1>
    </div>
    <div
      class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5"
    >
      <candidates-item
        v-for="candidate in store.candidates"
        v-bind:candidate="candidate"
        :key="candidate.id"
      ></candidates-item>
    </div>
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
