import axios from "axios";
import { createStore } from "vuex";

export const store = createStore({
    state() {
        return {
            user: null,
        };
    },

    mutations: {
        getUser: (state, user) => (state.user = user),
    },
    actions: {
        async fetchUser({ commit }) {
            try {
                const res = await axios.get("/api/getUser", {
                    headers: {
                        Accept: "application/json",
                    },
                });
                commit("getUser", res.data);
            } catch (err) {
                console.log(err.message);
            }
        },
    },
});
