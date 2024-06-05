<template>
  <div>
    <div v-if="!logado">
      <PageLogin v-if="temConta" />
      <PageCriarConta v-else />
    </div>
    <div v-else>
      <MenuHeader />
      <router-view />
    </div>
  </div>
  <ViewAlertaGeral :mensagem="mensagemAlerta" :visivel="exibirAlerta" :tipo="tipoAlerta" />
</template>

<script>
import { mapState } from 'vuex';
import PageLogin from './pages/PageLogin.vue';
import PageCriarConta from './pages/PageCriarConta.vue';
import MenuHeader from './components/MenuHeader.vue';
import ViewAlertaGeral from './components/views/ViewAlertaGeral.vue';

export default {
  data() {
    return {
      logado: false,
      temConta: false
    }
  },
  computed: {
    ...mapState(['mensagemAlerta', 'tipoAlerta', 'exibirAlerta'])
  },
  components: {
    PageLogin,
    MenuHeader,
    PageCriarConta,
    ViewAlertaGeral
  },
  mounted() {
    const token = this.$cookies.get('token');
    this.logado = token ? true : false;
    if (!this.logado) {
      this.temConta = !window.location.href.includes('Login/CriarConta');
    }
  }
}
</script>

<style>
.container-pai {
  margin: 10px;
  background-color: white;
  border-radius: 5px;
}

.form {
  padding: 10px 10px 0px 10px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 10px;
}

@media(max-width : 768px) {
  .form {
    grid-template-columns: 1fr;
  }
}
</style>
