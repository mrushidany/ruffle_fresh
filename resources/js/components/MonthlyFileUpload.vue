<template>
    <div class="row" style="height:100vh">
        <div class="col-md-6 offset-md-3 align-middle">
            <div class="card">
                <p class="title">Upload {{drawType}} Names</p>
                <p class="description">Please upload the csv,excel file to begin the raffle</p>

                <div class="row category-container text-center">
                    <!-- <div class="col-md-10 mb-3">
                        You have {{participants}} uploaded <br>
                        <router-link :to="{name:'raffle'}">Click here to proceed with current participants</router-link>
                    </div> -->

                    <div class="col-md-12">
                        <div v-if="success != ''" class="alert alert-success" role="alert">
                          {{success}}
                        </div>
                        <!-- <input type="file" name="file" placeholder="Drag and drop service icon here or browse"> -->
                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <div class="row mr-4 ml-0">
                                <label>Motorcycle File</label>
                                <input v-if="!isloading && success==''" type="file" class="form-control" v-on:change="onFileChange"  placeholder="Drag and drop service icon here or browse">
                            </div>
                            <div class="row mr-4 mt-4 ml-0">
                                <label>Monthly Cash Prize File</label>
                                <input v-if="!isloading && success==''" type="file" class="form-control" v-on:change="onFileChangeTwo"  placeholder="Drag and drop service icon here or browse">
                            </div>
                            <div class="row mr-4 mt-4 ml-0">
                                <label>Double Saving File</label>
                                <input v-if="!isloading && success==''" type="file" class="form-control" v-on:change="onFileChangeThree"  placeholder="Drag and drop service icon here or browse">
                            </div>
                            <button v-if="!isloading && success==''" class="btn btn-block cta-button mt-4" >Upload</button>
                            <h2 v-if="isloading">uploading please wait..</h2>
                        </form>
                            <br>
                        <button v-if="!isloading && success!=''" class="btn btn-block cta-button mt-4" @click="navigate()">Continue</button>
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
            drawType:'',
            file: '',
            fileTwo: '',
            fileThree: '',
            success: '',
            isloading:false,
            participants:0,
        }
    },
    mounted() {
        this.drawType = localStorage.getItem('currentDrawTypeName')
        this.init()
    },
    computed:{
        selectedDraw(){
            return this.$store.state.selectedDraw
        }
    },
    methods:{
        init(){
            this.axios.get('participants/index').then(response=>{
                console.log(response)
                this.participants = response.data['participants']
            }).catch(error=>{
                console.log(error)
            }).finally(()=>{
                this.isloading = false
            })
        },
        setSelectedDraw(draw){
            console.log(draw)
            this.selectedDraw = draw
        },
        onFileChange(e){
            console.log(e.target.files[0]);
            this.file = e.target.files[0];
        },
        onFileChangeTwo(e){
            console.log(e.target.files[0]);
            this.fileTwo = e.target.files[0];
        },
        onFileChangeThree(e){
            console.log(e.target.files[0]);
            this.fileThree = e.target.files[0];
        },
        formSubmit(e) {
            this.isloading = true
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('draw',localStorage.getItem('currentDrawId'))
            formData.append('file', this.file);
            formData.append('fileTwo', this.fileTwo);
            formData.append('fileThree', this.fileThree);

            axios.post('participants/import', formData, config)
            .then(function (response) {
                currentObj.success = response.data.message;
            })
            .catch(function (error) {
                currentObj.output = error;
            }).finally(()=>{
                this.isloading = false
                // this.navigate()
            });
        },
        navigate(){
            this.$router.push({name:'raffle'})
        }
    }
}
</script>

<style scoped>
    .card{
        padding: 100px;
        color: #9EA0A5;
        font-weight: 500;
    }
    .title{
        font-size: 12px;
        line-height: 10px;
    }
    .description{
        font-size: 18px;
        line-height: 22px;
        max-width: 300px;
    }
    .category-container{
        display: flex;
        flex-direction: row;
    }
    .category{
        height: 130px;
        width: 225px;

        background: #FCFCFC;
        color: black;
        border: 1px solid #979797;
        border-radius: 9px;

        line-height: 130px;
    }
    .category:hover{
        cursor: pointer;
    }
    .selected_category{
        background: #3DB0E6;
        color: white;
        border: 1px solid #3DB4E6;
        box-sizing: border-box;
        border-radius: 9px;
    }

    .label {
        display: flex;
        justify-content: space-around;
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
