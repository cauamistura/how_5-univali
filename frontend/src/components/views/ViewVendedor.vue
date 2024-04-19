<template>
    <div class="container-vendedor">
        <span class="nome">{{ this.vendedor.name }}</span>
        <span class="descricao" >{{ this.vendedor.description }}</span>
    </div>
</template>

<script>
export default {
    props: {
        vendedor: {
            type: Object,
            required: true
        }
    }
}
</script>

<style>
.container-vendedor {
    display: flex;
    flex-direction: column;
    align-items: left;
    justify-content: left;
    font-size: 12px;
}

.nome {
    font-weight: bold;
}

.descricao {
    font-size: 10px;
}
</style>