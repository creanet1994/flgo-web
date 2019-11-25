<template>

    <div>

      <md-toolbar md-elevation="1" style="background-color: #fff" >
        <h3 class="md-title" style="flex: 1; color: #001A48;">
          <hospital-box-icon/>
          <b>FLGOS</b>
        </h3>
        <router-link to="/login" tag="button" >
          <md-button>
            <b>Ingresar</b>
          </md-button>
        </router-link>
      </md-toolbar>

    </div>

</template>


<script>

  import HospitalBoxIcon from 'vue-material-design-icons/HospitalBox.vue';

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      HospitalBoxIcon,
    }
  }
</script>


<style type="text/css">

    .divIngresar{
      
      font-size: 30px;
      border-radius: 5px;
    }

    .nav{
      background-color: #fff;

      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
    }

    .divIngresar:hover{
      font-size: 30px;
      background-color: #fff;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);

    }


    .tituloPrincipal{
      background-color: #fff;
      font-size: 21px;
      color:#001A48;
      font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
      font-weight: bold;
    }
</style>