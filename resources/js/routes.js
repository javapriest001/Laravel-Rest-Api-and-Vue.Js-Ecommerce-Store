//
import vueRouter from "vue-router";
import Vue from "vue";
import about from "./components/about";

Vue.use(vueRouter);

export default [
    {
        path: '/',
        component: about,
    },
]



