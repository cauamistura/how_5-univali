<template>
    <div class="form container-pai">
        <div class="edits-data">
            <edit-data label="Data inicial" class="edit-balanco" @date-updated="(d) => { this.request.start_date = d }" />
            <edit-data label="Data Final" class="edit-balanco" @date-updated="(d) => { this.request.end_date = d }" />
        </div>

        <edit-radio :options="['Vendas', 'Compras']" name="opcoes" @input="(o) => { this.request.option = o; this.gerar = false }" />

        <div class="botoes">
            <botao-basico text="Gerar" @click="gerarBalanco" />
        </div>

        <grid-balanco-vue v-if="this.gerar" :titulos="this.request.option === 0 ? titulosVendas : titulosCompras" :dados="dados" />
    </div>
</template>

<script>
import EditData from '@/components/edits/EditData.vue';
import EditRadio from '@/components/edits/EditRadio.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import GridBalancoVue from '@/components/grids/GridBalanco.vue';
import api from '@/api';

const titulosVendas = ['Nome', 'Email', 'Descrição', 'Valor'];
const titulosCompras = ['Data', 'Nome', 'Quantidade', 'Valor'];

export default {
    components: {
        EditData,
        EditRadio,
        BotaoBasico,
        GridBalancoVue
    },
    data() {
        return {
            gerar: false,
            dados: [],
            titulosVendas,
            titulosCompras,
            request: {
                option: 0,
                start_date: Date.now(),
                end_date: Date.now()
            }
        };
    },
    methods: {
        gerarBalanco() {
            // Converta Date.now() em uma string de data no formato 'YYYY-MM-DD'
            const startDate = new Date(this.request.start_date).toISOString().split('T')[0];
            const endDate = new Date(this.request.end_date).toISOString().split('T')[0];

            // Atualize as datas na solicitação
            this.request.start_date = startDate;
            this.request.end_date = endDate;

            console.log(this.request);
            api.post('balanco/', this.request)
                .then(response => {
                    this.dados = response.data.dados;
                    this.gerar = true;
                })
                .catch(error => {
                    console.log(error);
                });
        },
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