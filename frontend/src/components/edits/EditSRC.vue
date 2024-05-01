<template>
  <div class="file">
    <label class="file-label">
      <input class="file-input" type="file" @change="onFileChange" ref="fileInput">
      <span class="file-cta">
        <span class="file-icon">
          <i class="fas fa-upload"></i>
        </span>
        <span class="file-label"> {{ buttonText }} {{ selectedFileName }} </span>
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
  data() {
    return {
      fileSelected: false,
      selectedFileName: ""
    };
  },
  mounted() {
    if (this.arquivoInicial) {
      this.fileSelected = true;
      this.selectedFileName = this.arquivoInicial.name;
    }
  },
  methods: {
    onFileChange(event) {
      const file = event.target.files[0];     
      this.$emit('arquivo-selecionado', file); // Emitir o arquivo selecionado
      this.fileSelected = true;
      this.selectedFileName = file.name;
    }
  },
  computed: {
    buttonText() {
      return this.fileSelected ? "Arquivo Selecionado - " : this.TextoBotao;
    }
  }
}
</script>

<style scoped>
.file-label {
  cursor: pointer;
}
</style>
