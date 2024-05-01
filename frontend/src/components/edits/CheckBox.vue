<template>
    <div class="field">
      <p class="control">
        <label class="checkbox">
          <input type="checkbox" v-model="isChecked" @change="emitirEvento">
          {{ label }}
        </label>
      </p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      label: String,
      valor: {
        type: Boolean,
        default: null
      }
    },
    data() {
      return {
        isChecked: this.valor
      };
    },
    methods: {
      emitirEvento() {
        this.$emit('checkbox-mudou', this.isChecked);
      }
    },
    mounted() {      
      if (this.valor === null)
        this.$emit('checkbox-mudou', false);
    }
  }
  </script>
  