<template>
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr style="font-size: 14px;">
                <th v-for="(titulo, index) in titulos" :key="index">{{ titulo }}</th>
            </tr>
        </thead>
        <tbody>
            <tr class="linha" v-for="(item, index) in dados" :key="index">
                <td>{{ formatIfData(item.coluna1) }}</td>
                <td>{{ item.coluna2 }}</td>
                <td>{{ item.coluna3 }}</td>
                <td>{{ numeroPreco(item.coluna4) }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        titulos: {
            type: Array,
            required: true
        },
        dados: {
            type: Array,
            required: true
        }
    },
    methods: {
        numeroPreco(valor) {
            if (!valor) {
                return "R$ 0,00";
            }
            return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
        },
        formatIfData(value) {                        
            const data = new Date(value);
            if (isNaN(data.getTime())) {             
                return value;
            }

            // Obter os componentes da data
            const dia = String(data.getDate()).padStart(2, '0');
            const mes = String(data.getMonth() + 1).padStart(2, '0');
            const ano = data.getFullYear();
            const hora = String(data.getHours()).padStart(2, '0');
            const minutos = String(data.getMinutes()).padStart(2, '0');

            // Construir a string formatada
            const dataFormatada = `${dia}/${mes}/${ano} - ${hora}:${minutos}`;
            return dataFormatada;
        }
    }
}
</script>

<style>
.linha {
    font-size: 14px;
}

.table td {
    vertical-align: inherit;
}
</style>
