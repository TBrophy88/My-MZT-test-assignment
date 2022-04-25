<template>
  <div class="rounded overflow-hidden shadow-lg">
    <!-- avatar -->
    <img class="w-full" src="/avatar.png" alt="" />

    <!-- name and description -->
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2">{{ candidate.name }}</div>
      <p class="text-gray-700 text-base">{{ candidate.description }}</p>
    </div>

    <!-- strengths -->
    <div class="px-6 pt-4 pb-2">
      <span
        v-for="strength in JSON.parse(candidate.strengths)"
        :key="strength.id"
        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
        >{{ strength }}</span
      >
    </div>

    <!-- options (Contact, Hire or already Hired img) -->
    <candidate-options v-bind:candidate="candidate"></candidate-options>
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
  props: ["candidate"],
};
</script>
