<template>
<div>
    <div class="popup-content" data-rel="ProductView">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row">
                    <div class="col-sm-6 col-xs-b30 col-sm-b0">
                        <div>
                            <section class="regular slider" v-if="Product.images.length">
                                <hr/>
                                <center>
                                    <img style="border: 1px solid whitesmoke; cursor: pointer; padding: 7px;" :src="image.path" width="64" height="64" v-for="image in Product.images" @click="ProductSelectedImage = image.path">
                                </center>
                                <hr/>
                                <br/>
                                <div>
                                    <center>
                                        <img class="img img-responsive" :src="ProductSelectedImage ? ProductSelectedImage : Product.images[0].path" />
                                    </center>
                                </div>
                            </section>
                            <section class="regular slider" v-if="!Product.images.length">
                                <br/>
                                <div>
                                    <center>
                                        <img class="img img-responsive" src="/img/customer/box.jpg" />
                                    </center>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="simple-article size-3 grey col-xs-b5" v-if="Product.category != null">{{ Product.category.name }}</div>
                        <div class="h3 col-xs-b25">{{ Product.name }}</div>
                        <div class="row col-xs-b25">
                            <div class="col-sm-6">
                                <select class="form-control simple-input" v-model="Grade">
                                <option disabled hidden></option>
                                <option value="1">NEW</option>
                                <option value="0.9">A-GRADE</option>
                                <option value="0.85">B-GRADE</option>
                              </select>
                            </div>
                            <div class="col-sm-6 col-sm-text-right">
                                <div class="simple-article size-5 grey">PRICE: <span class="color" >R{{ (Product.price*Grade).toFixed(2) }}</span></div>
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
                                <a class="button size-2 style-3 block" @click="ProductAdd()">
                                    <span class="button-wrapper">
                                      <span class="icon"><img src="/img/customer/exzo/icon-3.png" alt=""></span>
                                    <span class="text">add to cart</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="simple-article size-3 col-xs-b30" v-html="Product.detail"></div>
                    </div>
                </div>
            </div>
            <div class="button-close" @click="DismissView()"></div>
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
            that.ProductSelectedImage= "";
        });
    },
    data() {
        return {
            Product: {
                images: [],
            },
            OrderQuantity: 1,
            ProductSelectedImage: null,
            Grade: 1,
        }
    },
    methods: {
        DismissView: function() {
            if ($('.video-popup').hasClass('active')) {
                $('.video-popup .popup-iframe').html('');
            }

            $('.popup-wrapper, .popup-content').removeClass('active');
            $('html').removeClass('overflow-hidden');
        },
        OrderQuantityDecrease: function() {
            var that = this;
            if (that.OrderQuantity > 1) {
                that.OrderQuantity--;
            }
        },
        OrderQuantityIncrease: function() {
            this.OrderQuantity++;
        },
        ProductAdd: function() {
            var payload = {
                id: this.Product.id,
                qty: this.OrderQuantity * this.Grade,
                grade: this.Grade,
            };

            this.$root.$emit('AddBasketProduct', payload);
            this.DismissView();
        }
    }
}
</script>
