import axios from "axios";
import { defineStore } from "pinia";

export const useStore = defineStore("main", {
  state: () => ({
    candidates: [],
    wallet: {},
  }),
  actions: {
    initializeStore() {
      axios
        .get("/candidates-list")
        .then((res) => {
          this.candidates = res.data[0];
          this.wallet = res.data[1].coins;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    contactCandidate(candidateID) {
      axios
        .post("/candidates-contact", { candidateID: candidateID })
        .then((res) => {
          this.candidates = res.data[0];
          this.wallet = res.data[1].coins;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    hireCandidate(candidateID) {
      axios
        .post("/candidates-hire", { candidateID: candidateID })
        .then((res) => {
          this.candidates = res.data[0];
          this.wallet = res.data[1].coins;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
});
