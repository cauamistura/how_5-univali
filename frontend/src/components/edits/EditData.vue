<template>
    <div class="field">
        <label for="dateInput">{{ this.label }}:</label>
        <p class="control has-icons-left">
            <input id="dateInput" class="input" type="date" v-model="formattedDate" @input="updateDate">
        </p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            date: null,
            formattedDate: ''
        };
    },
    props: {
        initialDate: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: 'Data'
        }
    },
    mounted() {
        // Carregar data inicial, se houver        
        this.date = this.initialDate ? new Date(this.initialDate) : new Date();  
        this.formatDate();   
    },
    methods: {
        formatDate() {
            // Formatar a data como necessário
            if (this.date) {
                const day = String(this.date.getDate()).padStart(2, '0');
                const month = String(this.date.getMonth() + 1).padStart(2, '0');
                const year = this.date.getFullYear();
                this.formattedDate = `${year}-${month}-${day}`;
            } else {
                this.formattedDate = '';
            }
        },
        updateDate() {
            // Validar a entrada da data e atualizar this.date
            const parts = this.formattedDate.split('-');
            const year = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1; // Meses em JavaScript são baseados em zero
            const day = parseInt(parts[2], 10);
            const newDate = new Date(year, month, day);

            if (!isNaN(newDate.getTime())) {
                this.date = newDate;
                // Você pode emitir um evento para notificar o componente pai sobre a alteração da data
                // this.$emit('date-updated', this.date);
            } else {
                // Tratar erro de data inválida, se necessário
                console.error('Data inválida');
            }
        }
    }
};
</script>

<style scoped>
/* Estilos opcionais aqui */
</style>