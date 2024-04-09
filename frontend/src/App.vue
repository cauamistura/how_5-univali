<template>
  <div>
    <!-- <PageLogin v-if="!logado"/> -->
    <!-- <div v-else> -->
      <menu-header />
      <router-view />
    <!-- </div> -->
  </div>
</template>

<script>
// import PageLogin from './pages/PageLogin.vue';
import MenuHeader from './components/MenuHeader.vue';

export default {
  data() {
    return {
      logado: false
    }
  },
  components: {
    // PageLogin,
    MenuHeader
  },
}
</script>

<style></style>
