<template>
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr style="font-size: 14px;">
                <th></th>
                <th></th>
                <th>Nome</th>
                <th>Preço</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="linha" v-for="produto in produtos" :key="produto.id" :produto="produto">
                <td class="td-image">
                    <view-imagem-tabela :imagem="produto.src"/>
                </td>
                <td class="td-50px">
                    <view-disponibilidade :disponivel="(produto.ativo ==  0) ? false : true" />
                </td>
                <td>{{ produto.name }}</td>
                <td>{{ numeroPreco(produto.preco) }}</td>
                <td class="td-50px">
                    <botao-basico class="botao-td" :text="this.apenasSimbolo ? 'Editar' : '✏️'" tipo="is-warning"
                        @click="selecionar(produto)" />
                </td>
                <td class="td-50px">
                    <botao-basico class="botao-td" :text="this.apenasSimbolo ? 'Excluir' : '🗑'" tipo="is-danger"
                        @click="exluir(produto)" />
                </td>

            </tr>
        </tbody>
    </table>
</template>

<script>
import ViewImagemTabela from '@/components/views/ViewImagemTabela.vue';
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import ViewDisponibilidade from '../views/ViewDisponibilidade.vue';

export default {
    components: {
        ViewImagemTabela,
        BotaoBasico,
        ViewDisponibilidade
    },
    props: {
        produtos: {
            type: Array,
            required: true
        },
        selecionar: {
            type: Function,
            default: () => {}
        },
        exluir: {
            type: Function,
            default: () => {}
        }
    },
    data() {
        return {
            apenasSimbolo: false,
        }
    },
    methods: {
        verificarTela() {
            this.apenasSimbolo = window.innerWidth >= 768;
        },
        numeroPreco(valor) {
            if (!valor) {
                return "R$ 0,00";
            }
            return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
        }
    },
    created() {
        window.addEventListener('resize', this.verificarTela);
        this.verificarTela();
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.verificarTela);
    }
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