<template>
     <div class="tabs-block">
        <div class="container">
            <div class="tabulation-menu-wrapper text-center">
                <div class="tabulation-title simple-input">all</div>
                <ul class="tabulation-toggle">
                    <li><div class="h4 col-xs-b25 text-center">Featured Books</div></li>
                </ul>
            </div>
        </div>
        <div class="empty-space col-xs-b30 col-sm-b60"></div>
        <div class="tab-entry visible">
            <div class="slider-wrapper side-borders">
                <div class="swiper-button-prev hidden-xs hidden-sm"></div>
                <div class="swiper-button-next hidden-xs hidden-sm"></div>
                <div class="swiper-container" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lt-slides="4"  data-slides-per-view="5">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="product in featuredProducts">
                            <div class="product-shortcode style-5 small">
                                <!--<div class="product-label green">best price</div>
                                <div class="icons">
                                    <a class="entry"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    <a class="entry open-popup" data-rel="3"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a class="entry"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>-->
                                <div class="preview">
                                    <div class="swiper-container" data-loop="1" data-touch="0">
                                        <div class="swiper-button-prev style-1"></div>
                                        <div class="swiper-button-next style-1"></div>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" v-for="image in product.images">
                                                <img height="150" width="150" :src="image.path" alt="product-shortcode-image" />
                                            </div>
                                            <!--<div class="swiper-slide">
                                                <img src="img/customer/sell_books.jpg" alt="" />
                                            </div>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="title">
                                    <div class="simple-article size-1 color col-xs-b5" v-if="product.category != null"><a href="#"> {{product.category.name}} </a></div>
                                    <div class="h6 animate-to-green"><a href="#">{{product.name}}</a></div>
                                </div>
                                <!--<div class="description">
                                    <div class="simple-article text size-2">Mollis nec consequat at In feugiat molestie tortor a malesuada</div>
                                </div>-->
                                <div class="price">
                                    <div class="simple-article size-4 dark">R {{product.price}}</div>
                                </div>

                                <div class="preview-buttons">
                                    <div class="buttons-wrapper">
                                        <a class="button size-2 style-2 valign-middle-content open-popup" data-rel="ProductView"  @click="setProductview(product)">
                                            <span class="button-wrapper">
                                                <span class="icon"><img src="/img/customer/exzo/icon-1.png" alt=""></span>
                                                <span class="text">Learn More</span>
                                            </span>
                                        </a>
                                        <a class="button size-2 style-3" @click="productAdd(product)">
                                            <span class="button-wrapper">
                                                <span class="icon"><img src="/img/customer/exzo/icon-1.png" alt=""></span>
                                                <span class="text">Add To Cart</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination relative-pagination visible-xs visible-sm"></div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>

export default {
    data: function(){
        return {
            featuredProducts:[]
        }
    },
    methods: {
        getFeatured: function(){
            
            this.$http.get('/api/featured').then((response)=> {

                if(response.data.success){
            
                    this.featuredProducts = response.data.payload;
                }
            });
        },
        setProductview: function(product) {
            console.log('product view clicked');
            this.$root.$emit('ProductViewSelected', product);
        },
        productAdd: function(product) {
            var payload = {
                id:product.id,
                qty: 1,
                grade: 1,
            };

            this.$root.$emit('AddBasketProduct', payload);
        }
    },
    mounted() {
        this.getFeatured();
    }
}
</script>