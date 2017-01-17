<template>
<div>
    <div class="container">
        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="h4 col-xs-b25">On Sale</div>
            </div>
            <div class="col-md-4" v-for="Product in Products">
                <div class="banner-shortcode style-4">
                    <img v-if="Product.images.length" :src="Product.images[0].url" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                    <img v-else="!Product.images.length" src="/img/customer/box.jpg" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                    <div class="content">
                        <div class="cell-view">
                            <h4 class="title h4 col-xs-b5"><span class="color">{{ Product.name }}</span></h4>
                            <div class="description simple-article size-2 col-xs-b10">{{ Product.caption }}</div>
                            <div class="subtitle simple-article size-5 grey uppercase col-xs-b20"><span class="color">R{{ Product.price }}</span></div>
                            <a class="button size-2 style-3 open-popup" data-rel="ProductView" @click="setProductview(Product)">
                                <span class="button-wrapper">
                                    <span class="icon">
                                      <img src="img/customer/exzo/icon-4.png" alt="">
                                    </span>
                                <span class="text">
                                      More Information
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
</div>
</template>

<script>
export default {
    mounted() {
        var that = this;

        this.$root.$on('ProductDisplayDataReceived', function(Products) {
            that.Products = Products;
        });

    },
    data() {
        return {
            Products: [],
        }
    },
    methods: {
        setProductview: function(Product) {
            this.$root.$emit('ProductViewSelected', Product);
        }
    }
}
</script>
