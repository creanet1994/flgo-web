<template>
    <div id="main">
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>

  import Menu from './components/Menu.vue';
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      Menu
    }
  }
</script>