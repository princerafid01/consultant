<template>
    <select class="js-Selector" @input="updateValue">
      <option value="" selected="selected">Select Your Timezone</option>
      <option value="EST">(EST)</option>
      <option value="CST">(CST)</option>
      <option value="PST">(PST)</option>
    </select>
</template>

<script>
    export default {
        methods: {
            updateValue(event) {
                this.$emit('input',event.target.value)
            }
        },
    }
</script>

<style lang="scss">
.minimal {
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px), calc(100% - 2.5em) 0.5em;
    background-size: 5px 5px, 5px 5px, 1px 1.5em;
    background-repeat: no-repeat;
}
</style>