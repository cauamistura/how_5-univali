<template>
    <div class="container-home container-pai">
        <grid-home-produtos :dados="produtos" @adicionar="salvarPedido" />
    </div>
</template>

<script>
import GridHomeProdutos from '@/components/grids/GridHomeProdutos.vue';
import api from '@/api';

export default {
    components: {
        GridHomeProdutos
    },
    data() {
        return {
            produtos: [],
            filtroAtivo: {
                active: true
            },
        };
    },
    methods: {
        changeTab(tab) {
            this.activeTab = tab;
        },
        getProdutos() {
            api.get('/products', this.filtroAtivo).then(response => {                
                this.produtos = response.data.Products;
            });
        },
        salvarPedido(pedido) {
            api.post('/orders', pedido).then(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Pedido salvo com sucesso!',
                    tipo: 'is-success'
                });
            }).catch(() => {
                this.$store.dispatch('mostrarAlerta', {
                    mensagem: 'Erro ao salvar pedido!',
                    tipo: 'is-danger'
                });
            })
        },
    },
    created() {
        this.getProdutos();
    }
};
</script>

<style></style>