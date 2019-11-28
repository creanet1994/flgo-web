<template>
    <div>
        <md-toolbar md-elevation="1" style="background-color: #fff" >
            <h6 class="md-title" style="flex: 1; color: #001A48;">
                <hospital-box-icon/>
                <b>Registro de pacientes fonoaudiologicos</b>
            </h6>
                                
            <router-link to = "/dashboard">
                <md-button >
                    <b>{{profesional}}</b>
                </md-button>
            </router-link>

        </md-toolbar>

        <div class="divSubir" >
            <div class="form-group-row">
                <h3>Subir Excel</h3>
            </div>

            <div class="form-group-row">
                <div class="col-sm-10">
                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" accept=".XLSX, .CSV,.XLSM" class="form-control">
                </div>
            </div>

            <br>

            <button v-on:click="EventSubir()" class="btn btn-primary">Subir</button>
        </div>

        <el-footer class="footer" >Pie de página</el-footer>
    </div>
</template>

<script>
    import HospitalBoxIcon from 'vue-material-design-icons/HospitalBox.vue';
    import { mapActions, mapState, mapMutations } from 'vuex';

    export default {

        components: {
          HospitalBoxIcon,
        },

        computed: mapState(['profesional']),

        data(){
            return {
                file: ''
            }
        },

        mounted(){
          this.getUser();
        },

        methods: {

            ...mapActions(['getUser']),

            EventSubir(){
                let formData = new FormData();
                formData.append('file', this.file);
                axios
                    .post( '/auth/registro/importar',
                        formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function (response){
                        console.log(response)
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },

            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    };
</script>

<style type="text/css">
    .footer{
        border-top-style: solid;
        border-top-width: 1px;
        background-color: white;
        box-shadow: 0px -1px 5px -5px #FAFAFA
    }
    .divSubir{

        background-color: #FAFAFA;
        height: 470px;
    }
</style>