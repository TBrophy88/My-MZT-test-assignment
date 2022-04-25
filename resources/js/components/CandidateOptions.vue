<template>
  <div>
    <!-- show a hired img if the candidate is already hired -->
    <div v-if="candidate.hired == 1" class="p-6">
      <img class="w-1/3 float-right py-4 px-4" src="/hired.jpg" alt="" />
    </div>

    <!-- two buttons for non-hired candidates -->
    <div v-else class="p-6 float-right">
      <button
        :disabled="candidate.contacted == 1 || store.wallet < 5"
        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 hover:bg-teal-100 disabled:cursor-not-allowed focus:outline-none disabled:opacity-75 rounded shadow"
        v-on:click="contact(candidate.id)"
      >
        Contact
      </button>

      <button
        :disabled="candidate.hired == 1 || candidate.contacted == 0"
        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 hover:bg-teal-100 disabled:cursor-not-allowed focus:outline-none disabled:opacity-75 rounded shadow"
        v-on:click="hire(candidate.id)"
      >
        Hire
      </button>
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
  methods: {
    contact(candidateID) {
      this.store.contactCandidate(candidateID);
    },
    hire(candidateID) {
      this.store.hireCandidate(candidateID);
    },
  },
  props: ["candidate"],
};
</script>
