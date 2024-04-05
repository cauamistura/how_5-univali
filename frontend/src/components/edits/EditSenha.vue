<template>
    <div class="field">
        <p class="control has-icons-left">
            <input class="input" type="password" placeholder="Senha" v-model="model" />
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
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
            default: () => {}
        }
    },
    watch: {
        model() {
            this.preencheModel(this.model)    
        }
    }
}
</script>

<style>
</style>
