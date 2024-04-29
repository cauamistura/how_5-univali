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
      valor: Boolean
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
    }
  }
  </script>
  