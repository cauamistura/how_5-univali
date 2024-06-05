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
                <edit-src @arquivo-selecionado="atualizarModelo" v-if="false" />
                <div class="botoes">
                    <botao-basico text="Confirmar" :acao="confirmar" />
                    <botao-basico text="Cancelar" tipo="is-danger" :acao="() => { this.fechar() }" />
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
        EditSrc,
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
            src: ''
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
            this.produtoModal.src = '';

            if (this.produtoModal.ativo === undefined) {
                this.produtoModal.ativo = false;
            }
            if (this.produtoModal.preco === undefined) {
                this.produtoModal.preco = 0;
            }

            if (this.produtoModal.id) {
                api.put(`/products/${this.produtoModal.id}`, this.produtoModal)
                    .then(() => {
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
            this.$store.dispatch('mostrarAlerta', {
                mensagem: mensagem,
                tipo: tipo
            });
            setTimeout(() => {
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

.modal::before {
    content: "";
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, .5);
}

.modal {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    padding: 80px;
}

.modal_container {
    position: relative;

    z-index: 1;
    display: grid;
    align-items: end;
    grid-gap: 50px;
    padding: 50px 50px 50px 0;
    animation: fadeIn .3s forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate3d(50px, 0, 0);
    }

    to {
        opacity: 1;
        transform: translate3d(0px, 0, 0);
    }
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

.modal_img {
    grid-column: 1;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
}

.modal_img img {
    max-width: 300px;
    display: block;
}

.modal_dados {
    grid-column: 2;
    max-width: 600px;
}

.modal_titulo {
    font-size: 3rem;
}

.modal_btn {
    margin-top: 80px;
    background: #000;
    cursor: pointer;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    padding: 10px 25px;
    font-family: "Noto Serif";
}

.modal_btn.esgotado {
    background: #808080;
}

.modal_btn:active {
    background: #808080;
}
</style>