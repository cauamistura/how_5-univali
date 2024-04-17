<template>
    <div class="disponivel">
        <span class="icon is-small is-right">
            <i class="fa fa-check"></i>
        </span>
        <span v-if="mostrarLegenda">Disponivel</span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mostrarLegenda: true
        }
    },
    methods: {
        verificarTela() {
            this.mostrarLegenda = window.innerWidth >= 1000;
        },
    },
    created() {
        window.addEventListener('resize', this.verificarTela);
        this.verificarTela();
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.verificarTela);
    },
}
</script>

<style>
.disponivel {
    border-radius: 5px;
    width: 100%;
    background-color: #EBFFF1;
    color: green;
    padding: 5px;
    font-size: 10px;
}

.disponivel span {
    margin: 4px;
    overflow: hidden;
}
</style>