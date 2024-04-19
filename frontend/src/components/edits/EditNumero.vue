<template>
    <div class="number-input">
        <button class="minus" @click="decrement"></button>
        <input class="quantity" type="number" :readonly="somenteLeitura" :value="numero">
        <button class="plus" @click="numero++"></button>
    </div>
</template>

<script>

export default {
    data() {
        return {
            numero: 0
        }
    },
    props: {
        somenteLeitura: {
            type: Boolean,
            default: true
        }
    },
    methods: {
        decrement() {
            if (this.numero > 0) {
                this.numero--;
            }
        }
    }
}
</script>

<style>
input[type="number"] {
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    appearance: textfield;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
}

.number-input {
    border: 2px solid #ddd;
    display: inline-flex;
    font-size: 12px;
    border-radius: 5px;
}

.number-input button {
    outline: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin: 0;
    position: relative;
    height: 25px;
    width: 25px;
}

.number-input button:after {
    display: inline-block;
    position: absolute;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: '\f077';
    transform: translate(-50%, -50%) rotate(180deg);
}

.number-input button.plus:after {
    transform: translate(-50%, -50%) rotate(0deg);
}

.number-input input[type=number] {
    font-family: sans-serif;
    border: solid #ddd;
    border: none;
    font-weight: bold;
    text-align: center;
    height: 25px;
    width: 50px;
    font-size: 12px;
}

@media(max-width : 768px) {
    .number-input button {
        width: 15px;
    }

    .number-input input[type=number] {
        width: 30px;
    }
}
</style>