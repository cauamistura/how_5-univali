<template>
  <div class="container is-fuid">
    <div class="card">
      <div class="card-image">
        <h1 class="title">Entrar</h1>
        <h1 class="subtitle">Entre usando seus dados</h1>
        <edit-email class="edit-login" model="email" :preencheModel="(email) => this.email = email" />
        <edit-senha class="edit-login" model="senha" :preencheModel="(senha) => this.senha = senha" />
        <botao-basico :acao="logar" tipo="is-info" text="Logar" class="bota-basico" />
      </div>
      <div class="card-content">
        <p>Novo aqui?
          <a href="/Login/CriarConta">Crie sua conta</a>
        </p>
      </div>
    </div>
  </div>
  <alerta-geral :visivel="alerta" :mensagem="alertaMensagem" />
</template>

<script>
import BotaoBasico from "../components/botao/BotaoBasico.vue";
import EditEmail from "../components/edits/EditEmail.vue";
import EditSenha from "../components/edits/EditSenha.vue";
import AlertaGeral from "../components/views/ViewAlertaGeral.vue";

import api from "../api.js";

export default {
  data() {
    return {
      email: "",
      senha: "",
      alerta: false,
      alertaMensagem: ""
    }
  },
  components: {
    EditEmail,
    EditSenha,
    BotaoBasico,
    AlertaGeral
  },
  methods: {
    logar() {
      api.post("/login", {
        email: this.email,
        password: this.senha
      }).then((response) => {
        this.$cookies.set("token", response.data.token);
        window.location.href = "/";
      }).catch((error) => {
        if (error.response.status == 422) {
          this.alertaMensagem = "Email ou senha inválidos";
        } else {
          this.alertaMensagem = error.response.data.error;
        }
        this.alerta = true;
        setTimeout(() => {
          this.alerta = false;
        }, 2000);
      });
    }
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

.edit-login {
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