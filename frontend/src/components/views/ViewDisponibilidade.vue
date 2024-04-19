<template>
    <div :class="{
        'container-disponibilidade': true,
        'disponivel': this.disponivel,
        'indisponivel': !this.disponivel,
        'centralizar-disponiblidade': !this.mostrarLegenda
    }">
        <span class="icon is-small is-right">
            <i :class="this.disponivel ? 'fa fa-check' : 'fa fa-times'"></i>
        </span>
        <span v-if="mostrarLegenda">{{ this.disponivel ? 'Disponível' : 'Indisponível' }}</span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mostrarLegenda: true,
        }
    },
    props: {
        disponivel: {
            type: Boolean,
            default: true
        }
    },
    methods: {
        verificarTela() {
            this.mostrarLegenda = window.innerWidth >= 768;
        }
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
.container-disponibilidade {
    border-radius: 5px;
    width: 100%;
    padding: 5px;
    font-size: 10px;
}

.disponivel {
    background-color: #EBFFF1;
    color: green;
}

.indisponivel {
    background-color: #fab0b3;
    color: rgb(249, 0, 0);
}

.centralizar-disponiblidade {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>