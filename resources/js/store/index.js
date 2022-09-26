import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        to:[9,9,9,9,9,9,9,9,9,9],
        toX:[9,9,9,9,9,9,9,9,9,9],
        tos:10,
        hasCompleted:[false,false,false,false,false,false,false,false,false,false],
        selectedDrawType:''
    },
    getters:{
        getTo: state => {
            return state.to
        },
        getToX: (state) => (index) => {
            console.log('getter has been called')
            return state.toX[index]
        },
        getTos: state => {
            return state.tos
        },
        getHasCompleted: state => {
            return state.hasCompleted
        }
    },
    mutations: {
        setTo(state,data){
            // state.to.splice(data.index,1,data.value)
            state.to[data.index] = data.value
        },
        setToX(state,data){
            state.toX.splice(data.index,1,data.value)
            // console.log(state.toX)
            // state.toX[data.index] = data.value
            // console.log("inside mutation: "+data.index+" value: "+data.value)
        },
        setTos(state,data){
            state.tos = data.value
        },
        setHasCompleted(state,data){
            state.hasCompleted[data.index] = data.hasCompleted
        },
        setSelectedDrawType(state,draw){
            state.selectedDrawType = draw
        }
    }
})