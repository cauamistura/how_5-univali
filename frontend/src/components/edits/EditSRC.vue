<template>
  <div>
    <input type="file" @change="onFileChange" accept="image/*">
  </div>
</template>

<script>
export default {
  data() {
    return {
    };
  },
  methods: {
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.$emit('arquivo-selecionado', file);
      }
    }
  }
}
</script>