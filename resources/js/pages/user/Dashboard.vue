<template>
  <div class="d-flex justify-content-center align-items-md-center align-items-sm-start" style="height: 590px;">

    <div class="container menu-nav mx-2">

      <div class="d-flex justify-content-center row " style="color:black;">

        <router-link to="/registrar" style="height: 140px;" class="d-flex justify-content-center align-items-center col-12  col-md-3 m-2 button1" exact>
          <button class="text-button">
            <pencil-icon/>
            <b>REGISTRAR</b>
          </button>
        </router-link>

        <router-link to="/verRegistro" style="height: 140px;" class="d-flex justify-content-center align-items-center col-12  col-md-3 m-2 button3">
          <button class="text-button">
            <book-search-icon/>
            <b>VER REGISTROS</b>
          </button>
        </router-link>

        <router-link to="/registrar" style="height: 140px;" class="d-flex justify-content-center align-items-center col-12  col-md-3 m-2 button5">
          <button class="text-button">
            <cloud-search-icon/>
            <b>BUSCAR</b>
          </button>
        </router-link>

      </div>
      
      <div class="d-flex justify-content-center row">

        <router-link to="/registrar" style="height: 140px;" class="d-flex justify-content-center align-items-center col-12  col-md-3 m-2 button2">
          <button class="text-button">
            <chart-bar-icon/>
            <b>ESTADÍSTICAS</b>
          </button>
        </router-link>

        <router-link to="/registrar" style="height: 140px;" class="d-flex justify-content-center align-items-center col-12  col-md-3 m-2 button4">
          <button class="text-button">
            <clipboard-arrow-down-icon/>
            <b>DESCARGAR</b>
          </button>
        </router-link>

        <button style="height: 140px;" type="button" class="col-12  col-md-3 m-2 button6" @click.prevent="$auth.logout()">
          <exit-icon />
          <b>CERRAR SESIÓN</b>
        </button>

      </div>
    
    </div>

  </div>
</template>

<script>

  import CloudSearchIcon from 'vue-material-design-icons/CloudSearch.vue';
  import ExitIcon from 'vue-material-design-icons/ExitToApp.vue';  
  import PencilIcon from 'vue-material-design-icons/Pencil.vue';
  import ChartBarIcon from 'vue-material-design-icons/ChartBar.vue';  
  import BookSearchIcon from 'vue-material-design-icons/BookSearch.vue';  
  import ClipboardArrowDownIcon from 'vue-material-design-icons/ClipboardArrowDown.vue';
  import { mapActions, mapState, mapMutations } from 'vuex';

  export default {

    data() {
      return {
        //
      }
    },

    mounted(){
      this.getUser();
    },

    methods:{
      ...mapActions(['getUser']),
    },

    components: {
      ExitIcon,
      PencilIcon,
      ChartBarIcon,
      BookSearchIcon,
      ClipboardArrowDownIcon,
      CloudSearchIcon
    }
  }
</script>

<style type="text/css">

  .menu-nav .button1{
    background-color: #D1FAF2;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
  }

  .menu-nav .button2{
    background-color:  #BDC0FA;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
    color: #fff;
    text-decoration: none;
  }

  .menu-nav .button3{
    background-color: #E2BDFA;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
    color: #fff;
    text-decoration: none;
  }

  .menu-nav .button4{
    background-color: #8BCCF2;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
    color: #fff;
    text-decoration: none;
  }

  .menu-nav .button5{
    background-color: #ffeafc;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
    color: #fff;
    text-decoration: none;
  }

  .menu-nav .button6{
    background-color: #d226e8;
    border-radius: 5px;
    font-size: 15px;
    font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
    color: #f7f7f7;
    text-decoration: none;
  }


  .menu-nav .button1:hover{
    background-color: #4594AB;
  }

  .menu-nav .button2:hover{
    background-color: #F28BA4;
  }

  .menu-nav .button3:hover{
    background-color: #6AA1E6;
  }

  .menu-nav .button4:hover{
    background-color: #C436CD;
  }

  .menu-nav .button5:hover{
    background-color: #07D6C3;
  }

  .menu-nav .button6:hover{
    background-color: #A7CFCD;
  }

  .menu-nav.router-link-active:hover{
    color: #fff;
  }

  .text-button{
      color: #001777;
  }

  .text-button:hover{
      color: #001777;
  }
</style>
