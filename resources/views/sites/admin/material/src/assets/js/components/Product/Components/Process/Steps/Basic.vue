<template>
<div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">
        <div>
            <h1 style="font-weight: 300;" class="text-center">{{ process.creatingProduct ? 'Add a New Product' : 'Modify Product Properties' }}</h1>
        </div>
        <br/><br/>
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group input-group fg-float">
                            <span class="input-group-addon">R</span>
                            <div class="fg-line" :class="{ 'fg-toggled': product.price.length }">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                                <label class="fg-label">What's your Selling Price?</label>
                            </div>
                            <span class="input-group-addon last">ZAR</span>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <br/><br/>
            <center>
                <button type="submit" class="btn btn-lg btn-success waves-effect">{{ process.creatingProduct ? 'Create Product' : 'Modify Product' }}</button>
                <button type="button" class="btn btn-lg btn-default waves-effect" @click="$parent.endProcess()">Cancel</button>
            </center>
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
