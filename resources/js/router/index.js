import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export default new VueRouter({
    // mode: 'history',
    routes:[
        {
            path:'/',
            component: ()=> import('../components/DrawSelect.vue'),
            name:'draw-select'
        },
        {
            path:'/uploadfile',
            component: ()=> import('../components/UploadFile.vue'),
            name:'upload-file'
        },
        {
            path:'/raffle',
            component: ()=> import('../components/AnimateX.vue'),
            name:'raffle'
        },
        {
            path:'/monthlyuploadfile',
            component: ()=> import('../components/MonthlyFileUpload.vue'),
            name:'monthly-upload-file'
        },
        {
            path:'/grandprizeuploadfile',
            component: ()=> import('../components/GrandPrizeFileUpload.vue'),
            name:'grandprize-upload-file'
        },
        {
            path:'/motorcycleraffle',
            component: ()=> import('../components/weekly/AnimateMotorcycle.vue'),
            name:'motorcycle-raffle'
        },
        {
            path:'/cashprizeraffle',
            component: ()=> import('../components/weekly/AnimateCashPrize.vue'),
            name:'cashprize-raffle'
        },
        {
            path:'/monthlymotorcycleraffle',
            component: ()=> import('../components/monthly/AnimateMotorcycle.vue'),
            name:'monthly-motorcycle-raffle'
        },
        {
            path:'/monthlycashprizeraffle',
            component: ()=> import('../components/monthly/AnimateCashPrize.vue'),
            name:'monthly-cashprize-raffle'
        },
        {
            path:'/doublesavingraffle',
            component: ()=> import('../components/monthly/AnimateDoubleSaving.vue'),
            name:'monthly-doublesaving-raffle'
        },
        {
            path:'/weeklyselect',
            component: ()=> import('../components/weekly/WeekSelect.vue'),
            name:'weekly-select'
        },
        {
            path:'/monthlyselect',
            component: ()=> import('../components/monthly/MonthSelect.vue'),
            name:'monthly-select'
        },

    ]
})
