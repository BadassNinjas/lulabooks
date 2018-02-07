<template>
<div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">
        <div>
            <h1 style="font-weight: 300;" class="text-center">{{ process.creatingProduct ? 'Add a New Product' : 'Modify Product Properties' }}</h1>
        </div>

        <br><br>
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
                        <label class="fg-label">Think of a great caption for this product!</label>
                    </div>
                </div>
                <br>
                <div class="form-group input-group fg-float">
                    <span class="input-group-addon"></span>
                    <div class="fg-line" :class="{ 'fg-toggled': product.type }">
                        <select class="form-control" v-model="product.type">
                          <option value="book">Book</option>
                          <option value="stationery">Stationery</option>
                        </select>
                        <label class="fg-label">Choose what product type you want to add!</label>
                    </div>
                </div>
                <br>
                <div v-if="product.type === 'book'" class="form-group input-group fg-float">
                    <span class="input-group-addon"></span>
                    <div class="fg-line" :class="{ 'fg-toggled': Grade }">
                        <select class="form-control" v-model="Grade">
                          <option value="new">NEW</option>
                          <option value="A-GRADE">A-GRADE</option>
                          <option value="B-GRADE">B-GRADE</option>
                        </select>
                        <label class="fg-label">Choose Grade of book</label>
                    </div>
                </div>
                <div class="form-group input-group fg-float">
                    <span class="input-group-addon" @click="decreaseQty()" ><i class="zmdi zmdi-minus-circle colored"></i></span>
                    <div class="fg-line" :class="{ 'fg-toggled': inStock }">
                        <input v-model="inStock" type="text" class="input-sm form-control fg-input disabled">
                        <label class="fg-label">Enter quantity to increase stock by</label>
                    </div>
                    <span class="input-group-addon" @click="increaseQty()"><i class="zmdi zmdi-plus-circle colored"></i></span>
                </div>
                <!--<div class="row center-row">
                    <div class="col-md-12 center">
                        
                        
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group input-group fg-float">
                            <span class="input-group-addon">R</span>
                            <div class="fg-line" :class="{ 'fg-toggled': product.price }">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                                <label class="fg-label">What's your Selling Price?</label>
                            </div>
                            <span class="input-group-addon last">ZAR</span>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <br><br>
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
        'product',
        'assoc',

    ],

    data: function(){
        return {
           // product: this.product
           inStock: 0,
           Grade: '',
           assocProduct: {}
        }
    },
    mounted(){
        var that = this;
        this.$root.$on('assocProduct',function(data){

            if(data !== null){
                that.assocProduct = {
                    grade: data.grade,
                    stock: data.in_stock
                };
                that.inStock = that.assocProduct.stock;
                that.Grade = that.assocProduct.grade;
            }
            else{
                that.assocProduct = {
                    grade: '',
                    stock: 0
                };
                that.inStock = that.assocProduct.stock;
                that.Grade = that.assocProduct.grade;
            }
        });
    },
    watch: {
      Grade: function(){
        
        if(this.Grade === 'A-GRADE'){
            this.$http.get('/api/availability/'+ this.product.id+'/'+0.9).then((response) => {
                if (response.data.success) {
                    this.inStock = response.data.payload;
                    this.product.stock = this.inStock;
                    this.product.grade = this.Grade
                }
            });

        }else if(this.Grade === 'B-GRADE'){
            this.$http.get('/api/availability/'+ this.product.id+'/'+0.85).then((response) => {
                if (response.data.success) {
                    this.inStock = response.data.payload;
                    this.product.stock = this.inStock;
                    this.product.grade = this.Grade
                }
            });
        }

        else {
            this.$http.get('/api/availability/'+ this.product.id+'/'+1).then((response) => {
                if (response.data.success) {
                    this.inStock = response.data.payload;
                    this.product.stock = this.inStock;
                    this.product.grade = this.Grade
                }
            });
        }
      },
    },
    methods: {
        submitForm: function() {

            if(!this.Grade){
                this.Grade = 'new';
            }

            var payload = {
                product: this.product,
                grade: this.Grade,
                in_stock: this.inStock
            }
            if (this.process.creatingProduct) {
               
                this.$root.$emit('CreateProductRequested', payload);
            } else {
                this.$root.$emit('UpdateProductRequested', payload);
            }
        },
        increaseQty: function(){
            this.inStock++;

            this.product.stock = this.inStock;
        },
        decreaseQty: function(){
            this.inStock--;

            this.product.stock = this.inStock;
        }
        
    },
    created(){
        
    }

}
</script>

<style>
    .center {
        text-align: center;
    }
    .center-row {
        padding-bottom: 20px;
    }

    .colored{
        color: #4478ab;
    }
</style>
