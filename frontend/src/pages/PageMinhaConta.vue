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
</template>

<script>
import api from "../api.js";

import EditEmail from '@/components/edits/EditEmail.vue';
import EditString from '@/components/edits/EditString.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';

export default {
    data() {
        return {
            user: {},
        }
    },
    components: {
        EditEmail,
        EditString,
        BotaoBasico,
    },
    mounted() {
        this.GetUser();
    },
    methods: {
        GetUser() {
            api.get("/user-profile").then(response => {
                this.user = response.data.user;
            }).catch(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Erro ao carregar perfil do usuário',
                    tipo: 'is-success'
                });
            });
        },
        Cancelar() {
            this.GetUser();
            this.user.name = "Aguardando...";
            this.user.description = "Aguardando...";
        },
        Confirmar() {
            let request = {
                name: this.user.name,
                description: this.user.description,
                seller: false
            };

            let url = "user/update/" + this.user.id;

            console.log(this.user);
            api.put(url, request).then(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Perfil do usuário atualizado com sucesso!',
                    tipo: 'is-success'
                });
            }).catch(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Erro ao atualizar perfil do usuário',
                    tipo: 'is-success'
                });
            });
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