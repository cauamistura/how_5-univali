<template>
  <div class="container-cadastroproduto">
    <div class="botao-container">
      <botao-basico text="Cadastrar novo produto" tipo="is-info" class="botao-produto"/>
    </div>
    <GridCadastroProdutos/>
  </div>
</template>

<script>
import BotaoBasico from '@/components/botao/BotaoBasico.vue';
import GridCadastroProdutos from '@/components/grids/GridCadastroProdutos.vue';
export default {
  components: {
    GridCadastroProdutos,
    BotaoBasico
  }
}
</script>

<style>
.container-cadastroproduto {
  display: flex;
  flex-direction: column;
}

.botao-container {
  align-self: flex-end;
}

.botao-produto {
  margin: 10px;
  font-size: 13px;
}
</style>
