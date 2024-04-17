<template>
  <tr>
    <td class="td-image">
      <view-imagem-tabela />
    </td>
    <td class="td-50px">
      <view-disponibilidade />
    </td>
    <td>{{ this.produto.name }}</td>
    <td>{{ this.produto.price }}</td>
    <td>
      <edit-numero />
    </td>
    <td class="td-50px">
      <botao-basico class="botao-td" text="Adicionar" tipo="is-link"/>
    </td>
  </tr>
</template>

<script>
import EditNumero from '@/components/edits/EditNumero.vue';
import ViewDisponibilidade from '@/components/views/ViewDisponibilidade.vue';
import ViewImagemTabela from '@/components/views/ViewImagemTabela.vue';
import BotaoBasico from '../botao/BotaoBasico.vue';

export default {
  components: {
    EditNumero,
    ViewDisponibilidade,
    ViewImagemTabela,
    BotaoBasico
  },
  props: {
    produto: {
      type: Object,
      required: true
    }
  }
}
</script>

<style>
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
</style>