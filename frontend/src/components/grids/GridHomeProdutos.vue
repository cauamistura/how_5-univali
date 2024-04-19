<template>
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr style="font-size: 14px;">
                <th></th>
                <th>Vendedor</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="linha" v-for="produto in produtos" :key="produto.id" :produto="produto">
                <td class="td-image">
                    <view-imagem-tabela />
                </td>
                <td class="td-50px">
                    <view-vendedor :vendedor="produto.user" />
                </td>
                <td>{{ produto.name }}</td>
                <td>{{ PrecoFormatado(produto.price) }}</td>
                <td>
                    <edit-numero />
                </td>
                <td class="td-50px">
                    <botao-basico class="botao-td" :text="textoBotao" tipo="is-link" />
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import ViewImagemTabela from '@/components/views/ViewImagemTabela.vue';
import ViewVendedor from '@/components/views/ViewVendedor.vue';
import EditNumero from '@/components/edits/EditNumero.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';

export default {
    components: {
        ViewVendedor,
        EditNumero,
        ViewImagemTabela,
        BotaoBasico
    },
    data() {
        return {
            textoBotao: "Adicionar",
            produtos: [
                {
                    id: 1,
                    name: "Coxinha",
                    price: 5.00,
                    available: false,
                    user: {
                        id: 1,
                        name: "João",
                        description: "Vendedor"
                    }
                },
                {
                    id: 2,
                    name: "Pastel",
                    price: 3.00,
                    available: true,
                    user: {
                        id: 2,
                        name: "Maria",
                        description: "Vendedora"
                    }
                },
                {
                    id: 3,
                    name: "Pão de queijo",
                    price: 2.00,
                    available: true,
                    user: {
                        id: 3,
                        name: "José",
                        description: "Vendedor"
                    }
                }
            ]
        }
    },
    methods: {
        PrecoFormatado(value) {
            return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        },
        verificarTela() {
            this.textoBotao = window.innerWidth >= 768 ? "Adicionar" : "✔";
        }
    },
    created() {
        window.addEventListener('resize', this.verificarTela);
        this.verificarTela();
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.verificarTela);
    },
}
</script>

<style>
.linha {
    font-size: 14px;
}

.td-50px {
    max-width: 50px;
}

.table td {
    vertical-align: inherit;
}

.td-image {
    min-width: 100px;
}

.botao-td {
    width: 100%;
    font-size: 13px;
}

@media(max-width : 768px) {
    .linha {
        font-size: 12px;
    }
}
</style>