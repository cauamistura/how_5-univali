<template>
  <PageLogin v-if="!logado"/>
  <PageHome v-else/>
</template>

<script>
import PageLogin from './pages/PageLogin.vue';
import PageHome from './pages/PageHome.vue';

export default {
  data() {
    return {
      logado: false
    }
  },
  components: {
    PageLogin,
    PageHome
  }
}
</script>

<style></style>