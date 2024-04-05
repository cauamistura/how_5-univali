<template>
  <div class="container is-fuid">
    <div class="card">
      <div class="card-image">
        <h1 class="title">Entrar</h1>
        <h1 class="subtitle">Entre usando seus dados</h1>
        <edit-email v-model="email" :preencheModel="(email) => this.email = email" />
        <edit-senha class="edit-senha" v-model="senha" :preencheModel="(senha) => this.senha = senha" />
        <botao-basico :acao="logar" tipo="is-info" text="Logar" class="bota-basico" />
      </div>
      <div class="card-content">
        <p>Novo aqui?
          <a href="">Crie sua conta</a>
        </p>
      </div>
    </div>    
  </div>
  <alerta-geral :visivel="alerta"/>
</template>

<script>
import BotaoBasico from "../components/botao/BotaoBasico.vue";
import EditEmail from "../components/edits/EditEmail.vue";
import EditSenha from "../components/edits/EditSenha.vue";
import AlertaGeral from "../components/AlertaGeral.vue";

export default {
  data() {
    return {
      email: "",
      senha: "",
      alerta: false
    }
  },
  methods: {
    logar() {
      console.log(this.email, this.senha)

      this.alerta = !this.alerta
    }
  },
  components: {
    EditEmail,
    EditSenha,
    BotaoBasico,
    AlertaGeral
  }
}
</script>

<style>
.card {
  align-items: center;
}

.card-image {
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.container {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.edit-senha {
  width: 100%;
}

.bota-basico {
  width: 100%;
  background-color: #4094F7;
}

.card-content {
  background-color: #001AFF;
  color: white;
}

.card-content a {
  color: white;
  text-decoration: none;
  position: relative;
  font-style: italic;
  font-size: 0.8rem;
}

.card-content a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 100%;
  height: 1px;
  background-color: white;
}
</style>