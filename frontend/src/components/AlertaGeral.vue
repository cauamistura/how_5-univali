<template>
    <div v-if="visivel && !removido" :class="'notification ' + tipo + ' is-light'">
        <button @click="removido = !removido" class="delete"></button>
        <span class="mensagem">
            {{ mensagem }}
        </span>
    </div>
</template>

<script>
export default {
    props: {
        mensagem: {
            type: String,
            default: 'Menssagem padrão para a notificação'
        },
        visivel: {
            type: Boolean,
            default: true
        },
        tempo: {
            type: Number,
            default: 2000
        },
        tipo: {
            type: String,
            default: 'is-danger'
        }
    },
    data() {
        return {
            removido: false
        }
    },
    watch: {
        visivel() {
            this.removido = false;
            if (this.visivel) {
                setTimeout(() => {
                    this.removido = true;
                }, this.tempo);
            }
        }
    },
}
</script>

<style>
.notification {
    position: absolute;
    bottom: 2%;
    right: 2%;
    width: 50%;
    height: 8%;
}

@media(max-width : 768px) {
    .notification {
        width: 90%;
        font-size: 12px;
    }
}
</style>