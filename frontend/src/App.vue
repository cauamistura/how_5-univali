<template>
  <div>
    <div v-if="!logado">
      <PageLogin v-if="temConta"/> 
      <PageCriarConta v-else/>  
    </div>     
    <div v-else>
      <menu-header />
      <router-view />
    </div>
  </div>
</template>

<script>
import PageLogin from './pages/PageLogin.vue';
import PageCriarConta from './pages/PageCriarConta.vue';
import MenuHeader from './components/MenuHeader.vue';

export default {
  data() {
    return {
      logado: false,
      temConta: false
    }
  },
  components: {
    PageLogin,
    MenuHeader,
    PageCriarConta
  },
  mounted() {    
    // Verificar se há um token nos cookies
    const token = this.$cookies.get('token');
    this.logado = token ? true : false;    
    if (!this.logado) {
      this.temConta = !window.location.href.includes('Login/CriarConta');
    }
  }
}
</script>

<style></style>
