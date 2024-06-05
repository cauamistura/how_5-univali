<template>
    <div class="container is-fuid">
        <div class="card">
            <div class="card-image">
                <h1 class="title">Cadastrar-se</h1>
                <h1 class="subtitle">Cadastrar-se usando seus dados</h1>
                <edit-string class="edit" :preencheModel="(nome) => this.nome = nome" placeholder="Nome" />
                <edit-email class="edit" :preencheModel="(email) => this.email = email" />
                <edit-senha class="edit" :preencheModel="(senha) => this.senha = senha" />
                <edit-senha class="edit" :preencheModel="(confirmarSenha) => this.confirmarSenha = confirmarSenha"
                    placeholder="Confirmar Senha" />
                <edit-string class="edit" v-model="nome" :preencheModel="(setor) => this.setor = setor"
                    placeholder="Setor" />
                <botao-basico :acao="Cadastrar" tipo="is-info" text="Cadastrar-se" class="bota-basico" />
            </div>
            <div class="card-content">
                <p>Já tem conta?
                    <a href="/Login">Entrar</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import BotaoBasico from "../components/botao/BotaoBasico.vue";
import EditEmail from "../components/edits/EditEmail.vue";
import EditSenha from "../components/edits/EditSenha.vue";
import EditString from "../components/edits/EditString.vue";

import api from "../api.js";

export default {
    data() {
        return {
            email: "",
            senha: "",
            confirmarSenha: "",
            nome: "",
            setor: "",
        }
    },
    methods: {
        Cadastrar() {
            if (this.senha != this.confirmarSenha) {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Senhas não conferem',
                    tipo: 'is-danger'
                });
                return;
            }

            let request = {
                email: this.email,
                password: this.senha,
                name: this.nome,
                description: this.setor,
                seller: false
            }

            api.post("/register", request).then(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Cadastro realizado com sucesso',
                    tipo: 'is-success'
                });
            }).catch(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Erro ao cadastrar, verifique os dados e tente novamente',
                    tipo: 'is-danger'
                });
            });
        }
    },
    watch: {
        alerta() {
            if (this.alerta) {
                setTimeout(() => {
                    this.tipoAlerta = "is-danger";
                    this.alerta = false;
                }, 2000);
            }
        }
    },
    components: {
        EditEmail,
        EditSenha,
        BotaoBasico,
        EditString
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

.edit {
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