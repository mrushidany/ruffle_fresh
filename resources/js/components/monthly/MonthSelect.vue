<template>
  <div class="container mt-3">
    <div class="row" style="height:100vh">
        <div class="col-md-12">
            <div class="card">
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="row container d-flex justify-content-center">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <ul class="nav nav-pills" id="myTab" role="tablist">
                                        <li class="nav-item mr-4"><a class="nav-link mr-4" id="home-tab" data-toggle="tab" href="#motorcycle" role="tab" aria-controls="home" aria-selected="true" @click="activateMotorcycle()">Motorcycle Draw</a></li>
                                        <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#cash_prize" role="tab" aria-controls="profile" aria-selected="false" @click="activateCashPrize()">Cash Prize Draw</a></li>
                                        <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#double_saving" role="tab" aria-controls="profile" aria-selected="false" @click="activateDoubleSaving()">Double Saving Draw</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content mb-4">
                                    <div class="tab-pane fade" id="motorcycle" role="tabpanel" aria-labelledby="motorcycle-tab">
                                        <File :motorcycle="true" />
                                    </div>
                                    <div class="tab-pane fade" id="cash_prize" role="tabpanel" aria-labelledby="cash_prize-tab">
                                       <File :cashprize="true" />
                                    </div>
                                    <div class="tab-pane fade" id="double_saving" role="tabpanel" aria-labelledby="double_saving-tab">
                                       <File :doublesaving="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import File from './File.vue'
export default {
    data(){
        return {
            motorcycle: false,
            cashprize: false,
            doublesaving: false
        }
    },
    components : { File },
    methods: {
        activateMotorcycle(){
            this.motorcycle = true
            localStorage.setItem('currentSubDrawTypeId', 3)
        },
        activateCashPrize(){
            this.cashprize = true
            localStorage.setItem('currentSubDrawTypeId', 4)
        },
        activateDoubleSaving(){
            this.doublesaving = true
            localStorage.setItem('currentSubDrawTypeId', 5)
        },

    }
}

</script>

<style>
    .card{
        padding: 100px;
        color: #9EA0A5;
        font-weight: 500;
    }
</style>
