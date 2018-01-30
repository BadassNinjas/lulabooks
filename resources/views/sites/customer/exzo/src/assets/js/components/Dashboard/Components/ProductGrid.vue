<template style="transition: all 4s ease">
<div>
    <div class="empty-space col-xs-b35 col-md-b20"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="h4 col-xs-b25 text-center">FEATURE BOOKS</div>
        </div>
        
      <div class="col-sm-4" v-for="product in Products.data">
            <div class="product-shortcode style-1">
                <div class="title">
                    <div class="simple-article size-1 color col-xs-b5"><a href="#">{{ product.category != null ? product.category.name : 'Uncategorized' }}</a></div>
                    <div class="h6 animate-to-green"><a href="#">{{ product.name }}</a></div>
                </div>
                <div class="preview">
                    <img v-if="product.images.length" :src="product.images[0].path" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                    <img v-else="!product.images.length" src="/img/box.png" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                    <div class="preview-buttons valign-middle">
                        <div class="valign-middle-content open-popup" data-rel="ProductView" @click="setProductview(product)">
                            <a class="button size-2 style-3" href="#">
                                <span class="button-wrapper">
                                          <span class="icon"><img src="/img/customer/exzo/icon-1.png" alt=""></span>
                                <span class="text">More Information</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="price">
                    <div class="simple-article size-4"><span class="color">R{{ product.price}}</span></div>
                </div>
                <div class="description">
                    <div class="simple-article text size-2">{{ product.caption }}</div>
                </div>
            </div>
            <div class="empty-space col-xs-b35 col-md-b20"></div>
        </div>
    </div>
    <vue-pagination  :pagination="Products"
                  @paginate="getProducts()"
                  :offset="4">
    </vue-pagination>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
</div>
    
</template>

<script>

import VuePagination from './../../Shared/Pagination.vue';

export default {
    mounted() {
        var that = this;

/*this.$root.$on('ProductListDataReceived', function(Products) {
            that.Products = Products;
        });*/
        that.getProducts();
        //that.$root.$emit('ProductListDataRequested');
    },
    data() {
        return {
            Products: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,

        }
    },
    components: {
        VuePagination
    },
    methods: {
        setProductview: function(Product) {
            this.$root.$emit('ProductViewSelected', Product);
        },
        getProducts() {
            //this.$root.$emit('activateLoader');
            this.$http.get('/api/render/products?page='+this.Products.current_page).then((response) => {
                if (response.data.success) {
                    
                    this.Products = response.data.payload;
                    //this.$root.$emit('activateLoader');
                }
            });
        }

    }
}
</script>
