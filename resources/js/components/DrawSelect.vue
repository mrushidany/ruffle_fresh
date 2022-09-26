<template>
    <div class="row" style="height:100%">
        <div class="col-md-10 mt-3 offset-md-1 ">
            <div class="card">
                <p class="title">Choose Draw</p>
                <p class="description">Please select the draw that you would like to run the raffle</p>

                <div class="row draw-container text-center">
                    <div v-for="(type,index) in drawTypes" :key="index" class="col-md-3 my-3 draw"
                        :class="{selected_draw:selectedDrawType==type.id, ongoing: isActive(type.id)}" @click="setSelectedDrawType(type.id,type.name)">
                        <p class="name">{{type.name}}</p>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-6 position-relative">
                        <button v-if="!isloading && doProceed" class="btn btn-block cta-button mt-4 offset-md-6" @click="startDraw()">Continue</button>
                        <h5 v-if="isloading">loading...</h5>
                    </div>
                </div>
            </div>
        </div>
         <div class="modal fade" id="winnersModal" tabindex="-1" role="dialog" aria-labelledby="winnerModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg px-1" role="document">
                <div class="modal-content">
                    <div class="modal-body jackpot-modal-content">
                        <div class="row">
                             <div class="col-md-12 mt-5 justify-content-lg-end">
                                <table class="table table-striped table-sm">
                                    <thead class="table-header">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Winner</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Awards</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(winner,index) in winners" class="slist-item" :key="index">
                                            <td>{{index+1}}</td>
                                            <td>{{winner.phone}}</td>
                                            <td>{{winner.name}}</td>
                                            <td>{{winner.category_name}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-outline-primary export-button" @click="exportWinners()">Export</button>

                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <button type="button" class="btn btn-outline-danger mt-5 spin-button" @click="discardAndContinue()">Discard And Start New Draw</button>
                            <button type="button" class="btn btn-primary mt-5 spin-button" @click="closeModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            draws:[],
            drawTypes:[],
            winners:[],
            selectedDrawType:0,
            selectedDrawTypeName:'',
            isloading:false,
            doProceed:false,
            isGrandWinner:false,
            grandwinner: []
        }
    },
    mounted() {
        this.init()
    },
    methods:{
        init(){
            this.drawTypes = []
            this.draws = []

            this.isloading = true
            this.axios.get('draw/index').then(response=>{
                // console.log(response)
                if(response.status == 200){
                    const drawTypes = response.data['drawTypes']
                    const activeDraws = response.data['activeDraws']

                    console.log(activeDraws)

                    drawTypes.forEach(type => {
                        this.drawTypes.push(type)
                    });

                    activeDraws.forEach(draw=>{
                        this.draws.push(draw)
                    })
                }
            }).catch(error=>{
                console.log(error)
                alert("Error getting response from server")
            }).finally(()=>{
                this.isloading = false
            })
        },
        setSelectedDrawType(drawType,name){
            this.selectedDrawType = drawType
            this.selectedDrawTypeName = name

            this.$store.commit('setSelectedDrawType',drawType)
            if(this.isActive(drawType)){

                this.doProceed = false
                this.winners = []

                const draw = this.draws.filter(draw => draw.draw_type_id ==  drawType)
                localStorage.setItem('currentDrawId',draw[0].id)
                localStorage.setItem('currentDrawTypeId',drawType)

                draw[0].draw_winners.forEach(w=>{
                    w.name = w.participant.name
                    w.account_number = w.participant.account_number
                    w.phone_number = w.participant.phone_number
                    w.category_name = drawType==3?'Grand Prize':w.category.name
                    this.winners.push(w)
                })
                console.log(draw)
                this.openModal()
                return
            }
            this.doProceed = true
        },
        startDraw(){
            if(this.selectedDrawType == 0){
                alert('Please select draw type to proceed')
                return
            }

            this.isloading = true
            var body = {draw_type_id:this.selectedDrawType}

            this.axios.post('draw/start',body).then(response=>{
                console.log(response)
                if(response.status == 200){
                    const data = response.data['draw']
                    localStorage.setItem('currentDrawId',data.id)
                    localStorage.setItem('currentDrawTypeId',data.draw_type_id)
                    localStorage.setItem('currentDrawTypeName',this.selectedDrawTypeName)
                    this.navigate(data.draw_type_id)
                }
            }).catch(error=>{
                console.log(error)
                alert('Something went wrong')
            }).finally(()=>{
                this.isloading = false
            })
        },
        navigate(drawTypeId) {
           switch(drawTypeId){
                case 1 : this.$router.push({name:'weekly-select'})
                break;

                case 2 : this.$router.push({name:'monthly-select'})
                break;

                case 3 : this.$router.push({name:'grandprize-upload-file'})
                break;

                default : this.$router.push({name:'raffle'})
                return;
           }
        },
        isActive(drawType){
            var resp = false
            this.draws.forEach(draw => {
                if(draw.draw_type_id === drawType){
                    resp = true
                }
            });
            return resp
        },
        openModal(){
            $('#winnersModal').modal('toggle')
        },
        closeModal(){
            $('#winnersModal').modal('toggle')
        },
        discardAndContinue(){
            console.log(this.selectedDrawType)
            var d = this.draws.filter(draw => draw.draw_type_id == this.selectedDrawType);
            console.log(d[0].id)

            if(!d){
                alert('something went wrong')
                return;
            }

            this.isloading = true
            var body = {draw_id:d[0].id}

            this.axios.post('draw/discard',body).then(response=>{
                console.log(response)
                if(response.status == 200){
                    const data = response.data['draw']
                    const drawType = response.data['drawType']
                    localStorage.setItem('currentDrawId',data.id)
                    localStorage.setItem('currentDrawTypeId',drawType.id)
                    localStorage.setItem('currentDrawTypeName',drawType.name)
                    this.closeModal()
                    this.navigate(drawType.id)
                }
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
            })
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
        }
    }
}
</script>

<style scoped>
    .card{
        /* padding: 80px; */
        color: #9EA0A5;
        font-weight: 500;
        padding: 2rem 2rem;
    }
    .title{
        font-size: 12px;
        line-height: 10px;
    }
    .description{
        font-size: 18px;
        line-height: 22px;
    }
    .draw-container{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .draw{
        height: 130px;
        width: 225px;

        background: #FCFCFC;
        color: black;
        border: 1px solid #979797;
        border-radius: 9px;

        line-height: 130px;
        display: flex;
        justify-content: center;
    }
    .draw:hover{
        cursor: pointer;
    }
    .selected_draw{
        background: #3DB0E6;
        color: white;
        border: 1px solid #3DB4E6;
        box-sizing: border-box;
        border-radius: 9px;
    }
    .ongoing{
        border: 3px solid red;
    }

    .cta-button{
        background: linear-gradient(95.04deg, #3DB0E6 38.99%, #17A0D9 100%);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);
        border-radius: 3px;
        height: 60px;
        font-size: 16px;
        font-weight: 700;
        color: white;
    }
</style>
