<template>
    <div class="container-pai">
        <div class="form">
            <edit-string placeholder="Nome" :texto="user.name" :preencheModel="(nome) => this.user.name = nome" />
            <edit-email :somenteleitura="true" :texto="user.email" />
            <edit-string placeholder="Setor" :texto="user.description"
                :preencheModel="(description) => this.user.description = description" />

        </div>
        <div class="botoes">
            <botao-basico text="Confirmar" :acao="Confirmar" />
            <botao-basico text="Cancelar" tipo="is-danger" :acao="Cancelar" />
        </div>
    </div>

    <alerta-geral :visivel="alerta" :mensagem="alertaMensagem" :tipo="tipoAlerta" />
</template>

<script>
import api from "../api.js";

import EditEmail from '@/components/edits/EditEmail.vue';
import EditString from '@/components/edits/EditString.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import AlertaGeral from "@/components/views/ViewAlertaGeral.vue";

export default {
    data() {
        return {
            user: {},
            alerta: false,
            alertaMensagem: "",
            tipoAlerta: "is-danger"
        }
    },
    components: {
        EditEmail,
        EditString,
        BotaoBasico,
        AlertaGeral
    },
    mounted() {
        this.GetUser();
    },
    methods: {
        GetUser() {
            api.get("/user-profile").then(response => {
                this.user = response.data.user;
            }).catch(() => {
                this.MostrarAlerta("Erro ao carregar perfil do usuário", "is-danger");
            });
        },
        Confirmar() {
            console.log(this.user);
            api.put("user/update/" + this.user.id, {
                name: this.user.name,
                description: this.user.description,
                seller: false
            }).then(() => {
                this.MostrarAlerta("Perfil do usuário atualizado com sucesso", "is-success");
            }).catch(() => {
                this.MostrarAlerta("Erro ao atualizar perfil do usuário", "is-danger");
            });
        },
        Cancelar() {
            this.GetUser();
            this.user.name = "Aguardando...";
            this.user.description = "Aguardando...";
        },
        MostrarAlerta(mensagem, tipo) {
            this.alertaMensagem = mensagem;
            this.tipoAlerta = tipo;
            this.alerta = true;

            setTimeout(() => {
                this.alerta = false;
            }, 2000);
        }
    }
}
</script>

<style>
.botoes {
    display: flex;
    justify-content: right;
    margin-top: 20px;
}

.botoes button {
    margin: 10px
}
</style>