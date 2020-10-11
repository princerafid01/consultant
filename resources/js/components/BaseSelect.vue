<template>
    <div class="form-group mt-4">
        <label v-if="label">{{label}}</label>
        <select :value="value" @input="updateValue" :class="className" v-bind="$attrs">
            <option v-for="(option,index) in options"
            :value="option.name"
            :key="index"
            :selected="option.name === value"
            >{{option.name}}</option>
        </select>
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
            options: {
                type: Array,
                required: true
            },
            value: [String , Number],
            className: [String],
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
select {
    border-radius: 5px;
    font-size: 15px;
    color: #000;
    height: auto!important;
    padding: 12px !important;
}
select.custom {
    border: none;
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
-moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}
select:focus {
    border: 1px solid #455CC7!important;
    -webkit-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
-moz-box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
box-shadow: 4px 0px 14px -6px rgba(0,0,0,0.75);;
}
</style>