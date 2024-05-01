<template>
    <div class="container-home container-pai">
        <grid-home-produtos :filtro="activeTab" :dados="produtos" @adicionar="salvarPedido" />
    </div>
    <view-alerta-geral :mensagem="this.menssagemAlerta" :visivel="this.exibirAlerta" :tipo="this.tipoAlerta" />
</template>

<script>
import GridHomeProdutos from '@/components/grids/GridHomeProdutos.vue';
import ViewAlertaGeral from '@/components/views/ViewAlertaGeral.vue';
import api from '@/api';

export default {
    components: {
        GridHomeProdutos,
        ViewAlertaGeral
    },
    data() {
        return {
            produtos: [],
            menssagemAlerta: '',
            tipoAlerta: 'is-success',
            exibirAlerta: false
        };
    },
    methods: {
        changeTab(tab) {
            this.activeTab = tab;
        },
        getProdutos() {
            api.get('/products', {'ativo':true}).then(response => {
                this.produtos = response.data.Produto;
            });
        },
        salvarPedido(pedido) {
            api.post('/orders', pedido).then(() => {
                this.mostrarAlerta('Pedido salvo com sucesso', 'is-success');
            }).catch(() => {
                this.mostrarAlerta('Erro ao salvar pedido', 'is-danger');
            })
        },
        mostrarAlerta(mensagem, tipo) {
            this.menssagemAlerta = mensagem;
            this.tipoAlerta = tipo;
            this.exibirAlerta = true;
            setTimeout(() => {
                this.exibirAlerta = false;
            }, 1500);
        }
    },
    created() {
        this.getProdutos();
    }
};
</script>

<style></style>