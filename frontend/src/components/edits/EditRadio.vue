<template>
    <div class="control">
        <label v-for="(option, index) in options" :key="index" class="radio">
            <input type="radio" :name="name" :value="option" v-model="selectedOption">
            {{ option }}
        </label>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            type: Array,
            required: true
        },
        name: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            selectedOption: null
        };
    },
    
};
</script>

<style scoped>

</style>