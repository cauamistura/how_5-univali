<template>
    <div class="form">
        <div class="edits-data">
            <edit-data label="Data inicial" class="edit-balanco" />
            <edit-data label="Data Final" class="edit-balanco" />
        </div>

        <edit-radio :options="['Vendas', 'Compras']" name="opcoes" />

        <div class="botoes">
            <botao-basico text="Gerar" :acao="() => this.gerar = true" />
        </div>

        <grid-cadastro-produtos v-if="gerar" />
    </div>
</template>

<script>
import EditData from '@/components/edits/EditData.vue';
import EditRadio from '@/components/edits/EditRadio.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import GridCadastroProdutos from '@/components/grids/GridCadastroProdutos.vue';

export default {
    components: {
        EditData,
        EditRadio,
        BotaoBasico,
        GridCadastroProdutos
    },
    data() {
        return {
            gerar: false
        };
    }
};
</script>

<style scoped>
.form {
    grid-template-columns: 1fr;
}

.edits-data {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px;
}

@media(max-width : 768px) {
    .edits-data {
        grid-template-columns: 1fr;
    }
}
</style>