<template>
<div class="row">
    <div class="col-sm-12">
        <div>
            <h1 style="font-weight: 300;" class="text-center">{{ process.creatingProduct ? 'Add a New Product' : 'Modify Product Properties' }}</h1>
        </div>
        <form v-on:submit.prevent="submitForm()">
            <div>
                <div class="form-group input-group fg-float">
                    <span class="input-group-addon"></span>
                    <div class="fg-line" :class="{ 'fg-toggled': product.name.length }">
                        <input type="text" class="input-lg form-control fg-input" v-model="product.name">
                        <label class="fg-label">What is the name of your product?</label>
                    </div>
                </div>
                <br/>
                <div class="form-group input-group fg-float">
                    <span class="input-group-addon"></span>
                    <div class="fg-line" :class="{ 'fg-toggled': product.caption.length }">
                        <input type="text" class="input-lg form-control fg-input" v-model="product.caption">
                        <label class="fg-label">Think of a great caption to market this product!</label>
                    </div>
                </div>
                <br/>
                <div class="form-group input-group fg-float">
                    <span class="input-group-addon">R</span>
                    <div class="fg-line" :class="{ 'fg-toggled': product.price.length }">
                        <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                        <label class="fg-label">How much do you want to sell this item for?</label>
                    </div>
                    <span class="input-group-addon last">ZAR</span>
                </div>
                <br/>
            </div>
            <div class="empty-space col-xs-b20"></div>
            <button type="submit" class="btn btn-lg btn-success waves-effect">{{ process.creatingProduct ? 'Create Product' : 'Modify Product' }}</button>
        </form>
    </div>
</div>
</template>
<script>
export default {
    props: [
        'process',
        'product'
    ],
    methods: {
        submitForm: function() {
            if (this.process.creatingProduct) {
                this.$root.$emit('CreateProductRequested', this.product);
            } else {
                this.$root.$emit('UpdateProductRequested', this.product);
            }
        }
    },

}
</script>
