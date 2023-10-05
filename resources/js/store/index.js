import { createApp } from 'vue';
import { createStore } from 'vuex';

const store = createStore({
    state: {
        count: localStorage.getItem('playlist').length
    },
    mutations:{
        playListCount(state){
            console.log(localStorage.getItem('playlist'))
            if(localStorage.hasOwnProperty('playlist') && localStorage.getItem('playlist') != '')
            {
                state.count = localStorage.getItem('playlist').split(',')

                state.count = state.count.filter(function (el) {
                    return el != '';
                });

                state.count = state.count.length

            }else{
                state.count = null
            }
        },

    }
})

export default store
