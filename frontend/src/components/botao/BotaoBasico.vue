<template>
    <button :class="'button ' + tipo" @click="acao">
        {{ text }}
    </button>
</template>

<script>
// https://bulma.io/documentation/elements/button/
export default {
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
