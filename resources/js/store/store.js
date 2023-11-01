import axios from "axios";
import { createStore } from "vuex";

export const store = createStore({
    state() {
        return {
            user: null,
            filters: {},
        };
    },

    mutations: {
        getUser: (state, user) => (state.user = user),
        setFilter: (state, payload) =>
            (state.filters = { ...state.filters, ...payload }),
    },
    actions: {
        async fetchUser({ commit, state }) {
            try {
                const res = await axios.get("/api/getUser", {
                    headers: {
                        Accept: "application/json",
                    },
                });
                commit("getUser", res.data);
                return state.user;
            } catch (err) {
                console.log(err.message);
            }
        },
    },
});
