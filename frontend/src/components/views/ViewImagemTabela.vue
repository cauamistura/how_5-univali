<template>
    <figure class="image is-2by1">
        <img :src="url" class="image"
            alt="">
    </figure>
</template>

<script>
export default {
    props: {
        imagem: {
            type: String,
            default: "https://www.andy-cooks.com/cdn/shop/articles/20240125204816-andy-20cooks-20-20coxinha.jpg?v=1706215806"
        }
    },
    data() {
        return {
            url: this.imagem
        }
    },
}
</script>

<style>
.image {
    margin: 0 auto;
    display: block;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.1);
}
</style>