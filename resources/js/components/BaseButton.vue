<template>
    <div>
        <button :class="className" v-on="$listeners">
            <slot/>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            className: {
                type: String,
                default: ''
            },
        },
    }
</script>

<style lang="scss">
.btn-base {
    background: #455CC7;
    color: #fff !important;
    padding: 8px 30px;
    border-radius: 5px;
    font-weight: 400;
    font-size: 15px;
}
.btn-simple {
    background: transparent;
    color: #455CC7 !important;
    padding: 8px 30px;
    border-radius: 5px;
    font-weight: 400;
    font-size: 15px;
}
.btn-simple-border {
    background: transparent;
    color: #455CC7 !important;
    padding: 8px 30px;
    border-radius: 5px;
    font-weight: 400;
    font-size: 15px;
    border: 1px solid #455CC7;
}
.btn-simple:hover , .btn-simple-border:hover{
    background:none;
}

.rpx-5 {
    padding-right: 50px!important;
    padding-left: 50px!important;
}

</style>