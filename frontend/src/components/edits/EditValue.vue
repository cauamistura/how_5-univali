<template>

    <div class="field">
        <p class="control has-icons-left">
            <input class="input" :placeholder="placeholder" type="text" id="valorInput" v-model="valor" @input="formatarValor">
            <span class="icon is-small is-left">
                <i class="fa fa-dollar"></i>
            </span>
        </p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        valor: ''
      };
    },
    methods: {
      formatarValor() {
        // Remove caracteres não numéricos
        this.valor = this.valor.replace(/\D/g, '');
  
        // Converte o valor para número e formata como moeda brasileira
        this.valor = parseFloat(this.valor / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      }
    },
    props: {
      preencheModel: {
        type: Function,
        default: () => {}
      },
      placeholder: {
        type: String,
        default: "Preço"
      },
      valorProp: {
        type: Number,
        default: 0
      }
    },
    watch: {
      valor() {
        let valor = this.valor.replace(/\D/g, '') / 100;        
        
        this.preencheModel(valor);
      },
      valorProduto() {
        this.valor = this.valorProduto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      }
    },
    mounted() {
      this.valor = this.valorProp.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }
  }
  </script>
  