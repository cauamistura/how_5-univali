<template>
    <div class="field senha">
        <div class="control has-icons-left has-icons-right">
            <input class="input" :type="inputType" :placeholder="placeholder" v-model="model" />
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </div>
        <div class="icon is-small is-right senha-icon" @click="toggleVisibility">
            <i :class="visibilityIcon"></i>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            model: "",
            showPassword: false
        };
    },
    props: {
        preencheModel: {
            type: Function,
            default: () => { }
        },
        placeholder: {
            type: String,
            default: "Senha"
        }
    },
    computed: {
        inputType() {
            return this.showPassword ? "text" : "password";
        },
        visibilityIcon() {
            return this.showPassword ? "fas fa-eye-slash" : "fas fa-eye";
        }
    },
    methods: {
        toggleVisibility(event) {
            event.preventDefault();
            this.showPassword = !this.showPassword;
        }
    },
    watch: {
        model() {
            this.preencheModel(this.model);
        }
    }
};
</script>

<style>
.senha {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.senha-icon {
    cursor: pointer;
    margin-left: 5px;
}

</style>
