<template>
    <div class="form-group mt-4">
        <label v-if="label">{{label}} <span class="smallText">{{smallText}}</span></label>
        <input class="form-control p-4" :value="value" @input="updateValue" v-bind="$attrs">
    </div>
</template>

<script>
    export default {
        inheritAttrs: false,
        props: {
            label: {
                type: String,
                default: ''
            },
            value: [String , Number],
            smallText: [String]
        },
        methods: {
            updateValue(event) {
                this.$emit('input',event.target.value)
            }
        },
    }
</script>

<style scoped>
label {
    font-size: 16px;
    color: #000;
}
input{
    border-radius: 5px;
    font-size: 15px;
    color: #000;
    border: 1px solid #A7ACC0;
}
input:focus {
    border: 1px solid #455CC7!important;
    box-shadow: none;
}
.smallText{
    font-size: 16px;
    color: #868585;
}
</style>