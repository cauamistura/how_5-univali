<template>
    <div class="field">
        <p class="control has-icons-left has-icons-right">
            <input class="input" type="email" placeholder="Email" v-model="model" :readonly="somenteleitura" />
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
        </p>
    </div>
</template>

<script>

export default {
    data() {
        return {
            model: ""
        }
    },
    props: {
        preencheModel: {
            type: Function,
            default: () => { }
        },
        somenteleitura: {
            type: Boolean,
            default: false
        },
        texto: {
            type: String,
            default: ""
        }
    },
    watch: {
        model() {
            this.preencheModel(this.model)
        },
        texto() {
            this.model = this.texto;
        }
    }
}
</script>

<style></style>
