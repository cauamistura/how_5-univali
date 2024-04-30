<template>
    <section class="modal form" v-if="this.produto">
        <div class="modal_container">
            <div class="modal_dados">
                <button @click="fechar" class="modal_fechar">X</button>
                <edit-string placeholder="Nome" :texto="this.produto.name"
                    :preencheModel="(nome) => { this.produtoModal.name = nome }" />
                <edit-value placeholder="Preço" :texto="this.produto.preco"
                    :preencheModel="(value) => { this.produtoModal.preco = Number(value);}" />
                <check-box label="Disponivel" :valor="this.produto.ativo ? true : false"
                    @checkbox-mudou="(ativo) => { this.produtoModal.ativo = ativo }" />
                <edit-src TextoBotao="Imagem" />
                <div class="botoes">
                    <botao-basico text="Confirmar" :acao="confirmar" />
                    <botao-basico text="Cancelar" tipo="is-danger" :acao="() => { }" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import EditString from '../edits/EditString.vue';
import EditValue from '../edits/EditValue.vue';
import CheckBox from '../edits/CheckBox.vue';
import BotaoBasico from '../botao/BotaoBasico.vue';
import EditSrc from '../edits/EditSRC.vue';
import api from '@/api';

export default {
    components: {
        EditString,
        EditValue,
        CheckBox,
        BotaoBasico,
        EditSrc
    },
    props: {
        produto: {
            type: Object,
            default: null
        },
        fechar: {
            type: Function,
            default: () => { }
        }
    },
    data() {
        return {
            produtoModal: {}
        }
    },
    watch: {
        produto() {
            this.produtoModal = this.produto;
        }
    },
    mounted() {
        this.produtoModal = this.produto;
    },
    methods: {
        confirmar() {
            if (this.produtoModal.id) {
                api.put(`/product/${this.produtoModal.id}`, this.produtoModal)
                    .then(() => {
                        console.log('Produto atualizado com sucesso');
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.log(this.produtoModal)
                api.post('/product', this.produtoModal)
                    .then(() => {
                        console.log('Produto cadastrado com sucesso');
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

        },
        cancelar() {
            this.$emit('cancelar');
        }
    }
}
</script>

<style>
.modal::before {
    content: "";
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, .5);
}

.modal_container {
    z-index: 1;
    background-color: white;
    border-radius: 10px;
}

.modal_fechar {
    border-radius: 50%;
    border: 2px solid #000;
    width: 40px;
    height: 40px;
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 1rem;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
    cursor: pointer;
}
</style>