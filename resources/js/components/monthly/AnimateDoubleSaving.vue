<template>
    <div style="row padding:80px">
        <div class="col-md-6 offset-3 text-center">
            <h5 style="color:black;font-weight:bold; padding:12px 0px;font-size:32px;">NCBA JACKPOT - {{drawType}}</h5>
        </div>
        <div class="col-md-6 offset-3 my-4">
            <div class="row justify-content-start">
                <div class="col-md-3 offset-1 category" >
                    <p class="name">Double Saving</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 offset-3 text-center">
            <div class="number-container">
                <div v-for="(slot,index) in slots" :key="slot">
                    <counter-animate :ref="'n'+slot" :index="index" class="number" @complete="completedAnimation(slot)"></counter-animate>
                </div>
            </div>

            <button  v-if="!isloading && !hasCompletedDraw && !done" class="btn spin-button mt-5" :class="{none: isloading && hasCompletedDraw}" @click.prevent="spin()">Spin</button>
                <p v-if="isloading && !hasCompletedDraw">finding the lucky winner...</p>

                <button v-if="done" class="btn spin-button btn-complete" @click="exportAndCompleteDraw()">Export and Complete Draw</button>
        </div>

        <div class="col-md-8 offset-2 mt-5">
            <table class="table table-striped table-sm">
                <thead class="table-header">
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Winner</th>
                        <th scope="col">Name</th>
                        <th scope="col">Awards</th>
                    </tr>
                </thead>

                <tbody v-if="done">
                    <tr v-for="(winner,index) in winners" class="slist-item" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{winner.phone_number}}</td>
                        <td>{{winner.name}}</td>
                        <td>Double Saving</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="!hasCompletedDraw">
            <div class="modal fade" id="winnerModal" tabindex="-1" role="dialog" aria-labelledby="winnerModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body jackpot-modal-content">
                        <p class="title">Double Saving</p>
                        <img :src="'../images/double_savings.png'" style="height:190px;width:auto;object-fit:contain;">
                        <p class="winner">200 - winners !</p>

                        <div class="row" v-if="!isloading">
                            <div class="col-md-6 offset-md-3">
                                <button type="button" class="btn btn-primary mt-5" @click="complete()">Complete</button>
                            </div>
                        </div>
                        <p v-if="isloading">please wait...</p>
                    </div>
                </div>
            </div>
        </div>
        </div>



    </div>
</template>

<script>
import CounterAnimate from '../Counter-animate.vue'
export default {
    components:{CounterAnimate},
    mounted(){
        this.drawType = localStorage.getItem('currentDrawTypeName')
        this.drawTypeId = localStorage.getItem('currentDrawTypeId')
        // this.init()
    },
    data() {
        return {
            drawType:'',
            slots:10,
            times:0,
            lastSlotCounter:0,
            begin:true,
            winner:'',
            isGrandWinner:false,
            winnerCategoryImage:'../assets/',
            drawWinnerCount:0,
            account_number:'',
            phone_number:'',
            winner_name:'',
            winnerCategory:{},
            isloading:false,
            winnerAnimate:[],
            completedAnimations:[],
            winners:[],
            hasCompletedDraw:false,
            categories:[],
            completedCategories:[],
            drawTypeId:0,
            setGrandWinner: false,
            subDrawType: 4,
            done: false,
        }
    },
    computed:{
        icon(){
            return this.winnerCategoryImage+this.winnerCategory.image;
        }
    },
    methods:{
        toArray(phone){
            const array = phone.split("")
            this.winnerAnimate = array
            array.forEach(i=>this.completedAnimations.push(false))
        },
        start(){
            this.isGrandWinner = false
            this.isloading = true
            this.completedAnimations = []
            this.begin = true
            this.times = 0
            for (let index = 1; index <= this.slots; index++) {
                const data = {
                    index: index-1,
                    value: 9
                }
                this.completedAnimations.push(false)
                this.$store.commit('setToX',data)
                this.$refs['n'+index][0].play()
            }
        },
        replay(){
            for (let index = 1; index <= this.slots; index++) {
                this.$refs['n'+index][0].restart()
            }
        },
        pause(){
            for (let index = 1; index <= this.slots; index++) {
                this.$refs['n'+index][0].pause()
            }
        },
        completedAnimation(slot){
            if(this.winnerAnimate.length != this.slots){
                this.replay()
                return
            }
            if(slot == this.slots){
                this.lastSlotCounter++
            }
                if(!this.completedAnimations[slot-1]){
                    this.$refs['n'+slot][0].restart()
                    const data = {
                        index: slot-1,
                        value: this.winnerAnimate[slot-1]
                    }
                    this.$store.commit('setToX',data)
                }

                setTimeout(()=>{
                    this.completedAnimations[slot-1] = true

                    if(slot === this.slots && this.completedAnimations[slot-1]){

                        this.times++

                        if(this.begin && this.times == 2){
                            this.lastSlotCounter = 0
                            try {
                                this.isloading = false
                                this.openModal()

                            } catch (error) {
                                console.log(error)
                            }
                            this.begin = false
                        }
                    }
                },3000)
        },



        ///added
        init(){
            this.axios.get('draw/winners').then(response=>{
                if(response.status == 200){
                    this.categories = []
                    this.winners = []
                    const data = response.data['winners']
                    const cats = response.data['categories']
                    const comps = response.data['completedCategories']
                    this.drawWinnerCount = response.data['totalWinners']

                    if(this.drawTypeId==3){
                        this.drawWinnerCount = 1
                    }

                    data.forEach(winner => {
                        console.log(w)
                        var w = {
                            id: winner.id,
                            name: winner.participant.name,
                            phone: winner.phone_number,
                            category_name: this.drawTypeId==3?'Grand Prize':winner.category.name,
                            category_id: winner.category.id,
                            drawType:winner.draw.draw_type.name
                        }
                        this.winners.push(w)
                    });

                    cats.forEach(cat=>{
                        var c = {id:cat.id,name:cat.name}
                        this.categories.push(c)
                    })

                    comps.forEach(comp=>{
                        this.completedCategories.push(comp)
                    })

                }
            }).catch(error=>{
                console.log(error)
                if(error.response.status == 404){
                    this.$swal({
                        position: 'top-center',
                        icon: 'info',
                        title: 'No active draw',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    this.$router.push({name:'draw-select'})
                }
            }).finally(()=>{
                this.isloading = false
                this.winners.length==this.drawWinnerCount?this.hasCompletedDraw=true:this.hasCompletedDraw=false
            })
        },
        spin(){
            this.start()
            var body = {
                draw_type_id:localStorage.getItem('currentDrawTypeId'),
                draw_id:4,
                sub_draw_type: localStorage.getItem('currentSubDrawTypeId')
            }
            this.axios.post('spin',body).then(response=>{
                if(response.status == 200){
                    const data = response.data['winners']
                        data.filter((value, index) => {
                           this.toArray(value.phone_number)
                        })
                    this.winners = response.data['winners']
                }else if(response.status == 201){
                    this.pause()
                    this.$swal({
                        position: 'top-center',
                        icon: 'info',
                        title: response.data['message'],
                        showConfirmButton: true,
                        timer: 5000
                    })
                    this.isloading = true
                    this.hasCompletedDraw = true
                }else if(response.status == 202){
                    this.pause()
                    this.$swal({
                        position: 'top-center',
                        icon: 'info',
                        title: response.data['message'],
                        showConfirmButton: false,
                        timer: 2000
                    })
                }else if(response.status == 203){
                    this.pause()
                    this.$swal({
                        position: 'top-center',
                        icon: 'info',
                        title: response.data['message'],
                        showConfirmButton: false,
                        timer: 2000
                    })
                }

            }).catch(error=>{
                console.log(error)
                this.replay()
            })
        },
        exportAndCompleteDraw(){
            this.exportWinners()
            this.completeDraw()
        },
        completeDraw(){

            const drawId = localStorage.getItem('currentDrawId')
            this.axios.post('draw/complete/'+drawId).then(response=>{
                this.$router.push({name:'draw-select'})
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
                if(drawId === 3){
                    this.setGrandWinner = true
                    this.isGrandWinner = true
                }

            })
        },
        complete(){
            $('#winnerModal').modal('toggle')
            this.isloading = false
            this.hasCompletedDraw = false
            this.done = true
        },
        exportWinners(){
            const drawId = localStorage.getItem('currentDrawId')
            var today = new Date();
            const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            this.axios.get('export/winner/'+drawId,{responseType: 'arraybuffer'}).then(response=>{
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download', localStorage.currentDrawTypeName+'-'+date+'.xlsx');
                document.body.appendChild(fileLink);
                fileLink.click()
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
            })
        },
        openModal(){
            $('#winnerModal').modal({ backdrop: 'static', keyboard: false})
        },
        closeModal(){
            $('#winnerModal').modal('toggle')
            this.init()
        },
        discardAndContinue(){
            if(this.drawTypeId == 3){
                this.isloading = true
                var body = {
                    account_number:this.account_number,
                    activeDraw: 3
                }
                this.axios.post('grand_winner/disqualify', body).then(response=>{
                    console.log(response)
                    if(response.status == 200){
                    this.$swal({
                        position: 'top-center',
                        icon: 'success',
                        title: this.winner_name+ '( ' +this.account_number+' )' + ' has been disqualified',
                    })
                    this.closeModal()
                }
                }).catch(error=>{
                    console.log(error)
                }).finally(()=>{
                    this.isloading = false
                    this.setGrandWinner = false
                })
            }
            this.isloading = true
            var body = {
                account_number:this.account_number,
                activeDraw: localStorage.getItem('currentDrawId'),
            }
            this.axios.post('winner/disqualify',body).then(response=>{
                console.log(response)
                if(response.status == 200){
                    this.$swal({
                        position: 'top-center',
                        icon: 'success',
                        title: this.winner_name+ '( ' +this.account_number+' )' + ' has been disqualified',
                    })
                    this.closeModal()
                }
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
            })
        },
        saveWinner(phone){
            this.isloading = true
            var body = {
                account_number:phone,
                activeDraw: localStorage.getItem('currentDrawId'),
                drawTypeId: this.drawTypeId,
                winnerCategory: localStorage.getItem('currentDrawId')
            }
            console.log(body.winnerCategory)
            console.log(this.winnerCategory.id)
            this.axios.post('winner/store',body).then(response=>{
                console.log(response)
                if(response.status == 200){
                    this.done = true
                }
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
                this.setGrandWinner = true
            })
        },
    }
}
</script>

<style scoped>
    .number-container{
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        justify-content: space-evenly;
        margin-bottom: 30px;
    }
    .winner {
        color: black;
        font-size: 48px;
        font-weight: 700;
        line-height: 40px;
    }

    .number{
        padding: 0px 12px;
        /* margin: 0px 10px; */
        font-size: 32px;
        font-weight: 500;
        color: black;

        /* margin-left: auto;
        margin-right: auto; */

        border: 1px solid #3DB4E6;
        border-radius: 9px;
    }
    .spin-button-container{
        margin-top: 50px;
    }

    .none {
        display: none;
    }
    .spin-button{
        padding: 10px 10px;
        font-weight: 500;
        width:300px;

        display: block;
        margin-left: auto;
        margin-right: auto;

        background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);
        border-radius: 9px;

        color: white;
        font-size: 16px;
        font-weight: 700;
    }

    .btn-complete{
        background: linear-gradient(95.04deg, #e6513d 38.99%, #d94417 100%);
        color: white;
    }
    .list-container{
        margin: 10px 20px;
        padding: 20px 20px;
        text-align: left;
    }
    .list-item{
        font-size:40px;
        font-weight: bolder;
        color: rgb(100, 97, 97);
    }
    .export-button{
        position: absolute;
        right: 16px;
        min-width: 130px;
        height: 40px;

        background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);
        color: white;
    }
    .table-header{
        background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);
        color: white;
    }

    .category{
        height: 58px;
        width: 125px;

        background: #FCFCFC;
        color: black;
        border: 1px solid #979797;
        border-radius: 9px;

        line-height: 58px;
        text-align: center;
        margin: 5px 5px;
    }
    .category:hover{
        cursor: pointer;
    }
    .selected_category{
        background: #B6B8B9;
        color: white;
        border: 1px solid #B6B8B9;
        box-sizing: border-box;
        border-radius: 9px;
    }
    .jackpot-modal-content{
        padding: 50px;
        text-align: center;
    }
    .jackpot-modal-content .title{
        color: #2F2B2A;
        font-size: 32px;
        font-weight: 700;
        line-height: 24px;
    }
    .jackpot-modal-content .winner-number{
        color: #3DB0E6;
        font-size: 48px;
        font-weight: 700;
        line-height: 40px;
    }
    .jackpot-modal-content .winner-category{
        color: #706D6C;
        font-size: 32px;
        font-weight: 500;
        line-height: 24px;
    }

    .prizes-counter {
        background: #32CD30;
        color: white;
        border-radius: 3px;
        border: none;
    }
</style>
