<template>
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <view-linha-tabela-produtos v-for="produto in produtos" :key="produto.id" :produto="produto" />            
        </tbody>
    </table>
</template>

<script>
import ViewLinhaTabelaProdutos from '@/components/views/ViewLinhaTabelaProdutos.vue';
export default {
    data() {
        return {
            produtos: [
                {
                    id: 1,
                    name: "Coxinha",
                    price: 5.00,
                },
                {
                    id: 2,
                    name: "Pastel",
                    price: 3.00,
                },
                {
                    id: 3,
                    name: "Pão de queijo",
                    price: 2.00,
                }
            ]
        }
    },
    components: {
        ViewLinhaTabelaProdutos
    }
}  
</script>
  
<style>

</style>