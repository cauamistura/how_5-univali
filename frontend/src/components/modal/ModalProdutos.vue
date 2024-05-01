<template>
    <section class="modal form" v-if="this.produto">
        <div class="modal_container">
            <div class="modal_dados">
                <button @click="fechar" class="modal_fechar">X</button>
                <edit-string placeholder="Nome" :texto="this.produto.name"
                    :preencheModel="(nome) => { this.produtoModal.name = nome }" />
                <edit-value placeholder="Preço" :valor-prop="this.produto.preco"
                    :preencheModel="(value) => { this.produtoModal.preco = Number(value); }" />
                <check-box label="Disponivel" :valor="this.produto.ativo ? true : false"
                    @checkbox-mudou="(ativo) => { this.produtoModal.ativo = ativo }" />
                <edit-src TextoBotao="Imagem" @arquivo-selecionado="(src) => { this.produtoModal.src = src }"
                    :arquivo-inicial="null" />
                <div class="botoes">
                    <botao-basico text="Confirmar" :acao="confirmar" />
                    <botao-basico text="Cancelar" tipo="is-danger" :acao="() => { this.fechar() }" />
                </div>
            </div>
        </div>
    </section>
    <view-alerta-geral :mensagem="this.menssagemAlerta" :visivel="this.exibirAlerta" :tipo="this.tipoAlerta" />
</template>

<script>
import EditString from '../edits/EditString.vue';
import EditValue from '../edits/EditValue.vue';
import CheckBox from '../edits/CheckBox.vue';
import BotaoBasico from '../botao/BotaoBasico.vue';
import EditSrc from '../edits/EditSRC.vue';
import api from '@/api';
import ViewAlertaGeral from '../views/ViewAlertaGeral.vue';

export default {
    components: {
        EditString,
        EditValue,
        CheckBox,
        BotaoBasico,
        EditSrc,
        ViewAlertaGeral
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
            produtoModal: {},
            menssagemAlerta: '',
            tipoAlerta: 'is-success',
            exibirAlerta: false
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
            if (this.produtoModal.src === undefined) {
                this.mostrarAlerta('Selecione uma imagem', 'is-danger', false);
                return;
            }
            if (this.produtoModal.ativo === undefined) {
                this.produtoModal.ativo = false;
            }

            console.log(this.produtoModal);            
            if (this.produtoModal.id) {
                api.put(`/products/${this.produtoModal.id}`, this.produtoModal)
                    .then((t) => {
                        console.log(t);
                        this.mostrarAlerta('Produto atualizado com sucesso', 'is-success');
                    })
                    .catch(() => {
                        this.mostrarAlerta('Erro ao atualizar produto', 'is-danger', false);
                    });
            } else {
                api.post('/products', this.produtoModal)
                    .then(() => {
                        this.mostrarAlerta('Produto cadastrado com sucesso', 'is-success');
                    })
                    .catch(() => {
                        this.mostrarAlerta('Erro ao cadastrar produto', 'is-danger', false);
                    });
            }
        },
        cancelar() {
            this.fechar();
        },
        mostrarAlerta(mensagem, tipo, fechar = true) {
            this.menssagemAlerta = mensagem;
            this.tipoAlerta = tipo;
            this.exibirAlerta = true;
            setTimeout(() => {
                this.exibirAlerta = false;
                if (fechar)
                    this.fechar();
            }, 1500);
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