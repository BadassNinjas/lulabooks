<template>
<div>
    <div class="popup-content" data-rel="ProductView" v-if="Product != null">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row">
                    <div class="col-sm-6 col-xs-b30 col-sm-b0">
                        <div>
                            <section class="regular slider">
                                <hr/>
                                <center>
                                    <img style="border: 1px solid whitesmoke; cursor: pointer; padding: 7px;" :src="'https://' + image.hostname + image.path" width="64" height="64" v-for="image in Product.images" @click="ProductSelectedImage = 'https://' + image.hostname + image.path">
                                </center>
                                <hr/>
                                <br/>
                                <div>
                                    <center>
                                        <img class="img img-responsive" :src="ProductSelectedImage ? ProductSelectedImage : 'https://' + Product.images[0].hostname + Product.images[0].path" />
                                    </center>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="simple-article size-3 grey col-xs-b5">{{ Product.category.name }}</div>
                        <div class="h3 col-xs-b25">{{ Product.name }}</div>
                        <div class="row col-xs-b25">
                            <div class="col-sm-6">
                                <div class="simple-article size-5 grey">PRICE: <span class="color">R{{ Product.price }}</span></div>
                            </div>
                            <div class="col-sm-6 col-sm-text-right">
                                <div class="rate-wrapper align-inline">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="simple-article size-3 col-xs-b5">ITEM NO.: <span class="grey">#{{ Product.id }}</span></div>
                            </div>
                            <div class="col-sm-6 col-sm-text-right">
                                <div class="simple-article size-3 col-xs-b20">AVAILABLE.: <span class="grey">YES</span></div>
                            </div>
                        </div>
                        <div class="simple-article size-3 col-xs-b30">{{ Product.caption }}</div>
                        <div class="row col-xs-b40">
                            <div class="col-sm-12">
                                <div class="h6 detail-data-title size-1">quantity:</div>
                            </div>
                            <div class="col-sm-6">

                                <div class="quantity-select">
                                    <span class="minus" @click="OrderQuantityDecrease()"></span>
                                    <span class="number">{{ OrderQuantity }}</span>
                                    <span class="plus" @click="OrderQuantityIncrease()"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a class="button size-2 style-3 block" href="#">
                                    <span class="button-wrapper">
                                      <span class="icon"><img src="/img/customer/exzo/icon-2.png" alt=""></span>
                                    <span class="text">add to cart</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="simple-article size-3 col-xs-b30" v-html="Product.detail"></div>
                    </div>
                </div>
            </div>
            <div class="button-close"></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted() {
        var that = this;

        this.$root.$on('ProductViewSelected', function(Product) {
            that.Product = Product;
            that.OrderQuantity = 1;
            that.ProductSelectedImage = null;
        });
    },
    data() {
        return {
            Product: null,
            OrderQuantity: 1,
            ProductSelectedImage: null,
        }
    },
    methods: {
        OrderQuantityDecrease: function() {
            if (OrderQuantity > 1) {
                this.OrderQuantity--;
            }
        },
        OrderQuantityIncrease: function() {
            this.OrderQuantity++;
        }
    }
}
</script>
