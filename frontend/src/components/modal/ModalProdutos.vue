<template>
  <section class="modal form" v-if="produto">
    <div class="modal_container">
      <div class="modal_dados">
        <button @click="fechar" class="modal_fechar">X</button>
        <edit-string 
          placeholder="Nome" 
          :texto="produtoModal.name"
          :preencheModel="(nome) => { produtoModal.name = nome }" 
        />
        <edit-value 
          placeholder="Preço" 
          :valor-prop="produtoModal.price"
          :preencheModel="(value) => { produtoModal.price = Number(value); }" 
        />
        <check-box 
          label="Disponível" 
          :valor="produtoModal.active ? true : false"
          @checkbox-mudou="(ativo) => { produtoModal.active = ativo }" 
        />
        <input @change='newFile' type="file">
        <div class="botoes">
          <botao-basico text="Confirmar" :acao="confirmar" />
          <botao-basico text="Cancelar" tipo="is-danger" :acao="fechar" />
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
import api from '@/api';

export default {
  components: {
    EditString,
    EditValue,
    CheckBox,
    BotaoBasico
  },
  props: {
    produto: {
      type: Object,
      default: null
    },
    fechar: {
      type: Function,
      default: () => {
        window.location.reload();
      }
    }
  },
  data() {
    return {
      produtoModal: {},
      imagemTemporaria: null,
    }
  },
  watch: {
    produto() {
      this.produtoModal = { ...this.produto };
    }
  },
  mounted() {
    this.produtoModal = { ...this.produto };
  },
  methods: {
    confirmar() {
      // Verificação e inicialização dos campos
      if (this.produtoModal.active === undefined) {
        this.produtoModal.active = false;
      }
      if (this.produtoModal.price === undefined) {
        this.produtoModal.price = 0;
      }

      // Criação do FormData
      var formData = new FormData();
      formData.append('image', this.imagemTemporaria);
      formData.append('name', this.produtoModal.name);
      formData.append('price', this.produtoModal.price);
      formData.append('active', this.produtoModal.active);
    
      const request = this.produtoModal.id 
        ? api.post(`/products/${this.produtoModal.id}`, formData)
        : api.post('/products', formData);

      request
        .then(() => {
          this.mostrarAlerta(
            this.produtoModal.id ? 'Produto atualizado com sucesso' : 'Produto cadastrado com sucesso', 
            'is-success'
          );
        })
        .catch((error) => {
          console.error('Erro ao enviar o produto:', error);
          this.mostrarAlerta(
            this.produtoModal.id ? 'Erro ao atualizar produto' : 'Erro ao cadastrar produto', 
            'is-danger', 
            false
          );
        });
    },
    newFile(event) {
      console.log(event)
      this.imagemTemporaria = event.target.files[0]
    },
    mostrarAlerta(mensagem, tipo, fechar = true) {
      this.$store.dispatch('mostrarAlerta', {
        mensagem: mensagem,
        tipo: tipo
      });
      setTimeout(() => {
        if (fechar) this.fechar();
      }, 1500);
    }
  }
};
</script>
  
<style>
.modal::before {
    content: "";
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