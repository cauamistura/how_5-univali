<template>
    <div class="field">
        <p class="control has-icons-left">
            <input class="input" :placeholder="placeholder" v-model="model" />
            <span class="icon is-small is-left">
                <i class="fa fa-file"></i>
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
        },
        placeholder: {
            type: String,
            default: ""
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
