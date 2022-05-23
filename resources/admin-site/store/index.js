import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        userInfo: [],
    },
    getters:{
        userInfo(state){
            return state.userInfo;
        },
    },
    mutations: {
        changeUserInfo(state, newUserInfo) {
            state.userInfo = newUserInfo;
        },
    },

    actions: {
        handleChangeUserInfo(context, newUserInfo) {
            context.commit('changeUserInfo', newUserInfo)
        },
    }
})
