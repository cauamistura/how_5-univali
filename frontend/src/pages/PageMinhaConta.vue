<template>
    <div>
        <div class="columns is-centered">
            <div class="column is-6">
                <edit-string placeholder="Nome" :texto="user.name"/>
                <edit-email somenteleitura="true" :texto="user.email"/>
                <edit-string placeholder="Setor" :texto="user.description"/>
                <botao-basico />
            </div>
        </div>
    </div>
    <alerta-geral :visivel="alerta" :mensagem="alertaMensagem" :tipo="tipoAlerta" />
</template>

<script>
import api from "../api.js";

import EditEmail from '@/components/edits/EditEmail.vue';
import EditString from '@/components/edits/EditString.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import AlertaGeral from '@/components/AlertaGeral.vue';

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
        api.get("/user-profile").then(response => {
            this.user = response.data.userData;
        }).catch(() => {
            this.alertaMensagem("Erro ao carregar perfil do usuário");
            this.alerta = true;

            setTimeout(() => {
                this.alerta = false;
            }, 2000);
        });
    },
}
</script>

<style>
.columns {
    margin: auto;
    height: 100vh;
}
</style>