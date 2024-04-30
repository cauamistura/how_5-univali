<template>
    <div class="file">
      <label class="file-label">
        <input class="file-input" type="file" @change="onFileChange" ref="fileInput">
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-upload"></i>
          </span>
          <span class="file-label"> Escolha um arquivo… </span>
        </span>
      </label>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      arquivoInicial: {
        type: File,
        default: null
      },
      TextoBotao: {
        type: String,
        default: "Escolha um arquivo…"
      }
    },
    mounted() {
      if (this.arquivoInicial) {
        this.$refs.fileInput.files = this.arquivoInicial;
      }
    },
    methods: {
      onFileChange(event) {
        const file = event.target.files[0];
        this.$emit('arquivo-selecionado', file);
      }
    }
  }
  </script>
  
  <style scoped>
  .file-label {
    cursor: pointer;
  }
  </style>
  