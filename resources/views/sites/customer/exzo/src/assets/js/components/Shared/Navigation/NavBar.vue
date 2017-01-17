<template>
<div>
    <div class="header-bottom">
        <div class="content-margins">
            <div class="row">
                <div class="col-xs-5 col-sm-5">
                    <router-link tag="a" to="/" id="logo"><img src="img/lulalogo.png" alt="" /></router-link>
                </div>
                <div class="col-xs-7 col-sm-7 text-right">
                    <div class="nav-wrapper">
                        <div class="nav-close-layer"></div>
                        <nav>
                            <ul>
                                <li class="active">
                                    <router-link tag="a" to="/">Home</router-link>
                                </li>
                                <li class="megamenu-wrapper">
                                    <a href="products1.html">products</a>
                                    <div class="menu-toggle"></div>
                                    <div class="megamenu">
                                        <div class="links">
                                            <router-link tag="a" :to="'/' + Category.name" v-for="Category in Categories">{{ Category.name }}</router-link>
                                        </div>
                                        <div class="content">
                                            <div class="row nopadding">
                                                <div class="col-xs-6" v-for="Product in NavProducts">
                                                    <div class="product-shortcode style-5">
                                                        <div class="product-label green">best price</div>
                                                        <div class="icons">
                                                            <!-- <a class="entry"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a class="entry open-popup" data-rel="3"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                            <a class="entry"><i class="fa fa-heart-o" aria-hidden="true"></i></a> -->
                                                        </div>
                                                        <div class="preview">
                                                            <div class="swiper-container" data-loop="1">
                                                                <div class="swiper-button-prev style-1"></div>
                                                                <div class="swiper-button-next style-1"></div>
                                                                <div class="swiper-wrapper">
                                                                    <div class="swiper-slide" v-for="Img in Product.images">
                                                                        <img :src="Img.url" alt="" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content-animate">
                                                            <div class="title">
                                                                <div class="shortcode-rate-wrapper">
                                                                    <div class="rate-wrapper align-inline">
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="h6 animate-to-green"><a href="product.html">{{ Product.name }}</a></div>
                                                            </div>
                                                            <div class="description">
                                                                <div class="simple-article text size-2">{{ Product.caption }}</div>
                                                            </div>
                                                            <div class="price">
                                                                <div class="simple-article size-4 dark">R{{ Product.price }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="preview-buttons">
                                                            <div class="buttons-wrapper">
                                                                <a class="button size-2 style-2 open-popup" data-rel="ProductView" @click="setProductview(Product)">
                                                                    <span class="button-wrapper">
                                                                         <span class="icon"><img src="img/customer/exzo/icon-1.png" alt=""></span>
                                                                    <span class="text">Learn More</span>
                                                                    </span>
                                                                </a>
                                                                <a class="button size-2 style-3" @click="addProduct(Product.id)">
                                                                    <span class="button-wrapper">
                                                                         <span class="icon"><img src="img/customer/exzo/icon-3.png" alt=""></span>
                                                                    <span class="text">Add To Cart</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="contact1.html">contact</a></li>
                            </ul>
                            <div class="navigation-title">
                                Navigation
                                <div class="hamburger-icon active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="header-bottom-icon toggle-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <div class="header-bottom-icon visible-rd"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    <div class="header-bottom-icon visible-rd">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <span class="cart-label">5</span>
                    </div>
                </div>
            </div>
            <div class="header-search-wrapper">
                <div class="header-search-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                                <form>
                                    <div class="search-submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <input type="submit" />
                                    </div>
                                    <input class="simple-input style-1" type="text" value="" placeholder="Enter keyword" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="button-close"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted() {
        var that = this;

        this.$root.$on('CategoryDataReceived', function(Categories) {
            that.Categories = Categories;
        });

        this.$root.$on('ProductDisplayDataReceived', function(Products) {
            that.Products = Products;
            that.NavProducts = Products.slice(0,2);
        });
    },
    data() {
        return {
            Categories: [],
            Products: [],
            NavProducts: []
        }
    },
    methods: {
        setProductview: function(Product) {
            this.$root.$emit('ProductViewSelected', Product);
        },
        addProduct: function(Id) {
            var payload = {
                id: Id,
                qty: 1,
            };

            this.$root.$emit('AddProduct', payload);
        }
    }
}
</script>
