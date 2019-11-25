<template>

  <div class="d-flex justify-content-center align-items-md-center align-items-center" style="height: 590px;">
    <form class="row col-12 col-sm-10 col-md-8 d-flex justify-content-center" @submit.prevent="login" method="post">
        <div class="col-12 col-lg-8">

          <div class="col-12 d-flex justify-content-center align-items-center" style="background-color: #FAFAFA;height: 100px;">
            <img src="../images/logo.png" style="height: 80px; width: 80px;">
            <h4 class="ml-2" style="color: #0F0E39"><b>Registro de pacientes</b></h4>
          </div>

          <div class="mt-3 alert alert-danger d-flex justify-content-center " style="height: 50px;"v-if="has_error && !success">
            <p v-if="error == 'login_error'">Error al validar credenciales.</p>
            <p v-else>Las credenciales no coincien con nuestros registros.</p>
          </div>

          <div class="col-12" style="background-color: #FAFAFA;height: 200px;">
            <md-field>
              <label for="email">Correo electrónico</label>
              <md-input type="email" name="email" id="email" autocomplete="email" v-model="email" required/>
              <small id="emailHelp" class="md-helper-text">Nunca compartiremos su correo electrónico con nadie.</small>
            </md-field>

            <md-field class="mt-5">
              <label for="password">Contraseña</label>
              <md-input type="password" name="password" id="password" autocomplete="password" v-model="password" required/>
              <small id="emailHelp" class="md-helper-text">Si lo olvidó contactarse con soporte.</small>
            </md-field>

          </div>

          <div class="col-12 d-flex justify-content-between" style="background-color: #FAFAFA;height: 100px;">

            <router-link to="/" style="color: white" >
              <md-button  class="md-dense md-primary">Volver</md-button>
            </router-link>            

            <md-button type="submit" class="md-dense md-raised md-primary">
              <b>Ingresar</b>
            </md-button>

          </div>
        </div>
    </form>
  </div>

</template>

<script>

  import AccountCircleIcon from 'vue-material-design-icons/AccountCircle.vue';

  export default {
    components: {
      AccountCircleIcon
    },

    data() {
      return {
        errorCorreo: false,
        errorPassword: false,
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: ''
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
          // Obtener el objeto de redireccionamiento
          var redirect = this.$auth.redirect()
          var app = this
          this.$auth.login({
            data: {
              email: app.email,
              password: app.password
            },
            success: function() {
              // handle redirection
              app.success = true
              const redirectTo = 'dashboard'
              this.$router.push({name: redirectTo})
            },
            error: function() {
              app.has_error = true
              app.error = res.response.data.error
            },
            rememberMe: true,
            fetchUser: true
          })
        

      }
    }
  }
</script>

<style type="text/css">
  
</style>