<template>
    <button :class="classeCss" @click="acao">
        {{ text }}
    </button>
</template>

<script>
// https://bulma.io/documentation/elements/button/
export default {
    data() {
        return {
            classeCss: 'button '
        }
    },
    created() {
        this.classeCss += this.tipo;
    },
    props: {
        text: {
            type: String,
            default: 'Botão'
        },
        tipo: {
            type: String,
            default: 'is-success'
        },
        acao: {
            type: Function,
            default: () => { }
        }
    }
}
</script>

<style>
    .button {
     color: white;
     font-weight: 590;
    }
</style>
