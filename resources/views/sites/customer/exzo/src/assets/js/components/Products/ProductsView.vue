<template>
<div class="container">
    <div class="empty-space col-xs-b15 col-sm-b30"></div>
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <div class="align-inline spacing-1" v-if="products.length">
                <div class="h4"><span v-if="category.parent">{{ category.parent.name }} &raquo; </span> {{ category.name }}</div>
            </div>
            <div class="align-inline spacing-1" v-else-if="products.length == 0">
                <div class="h6 text-center">There are no items listed under {{ category.name }} specifically, select a sub-category on the left to explore this section.</div>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="products-content">
                <div class="products-wrapper">
                    <div class="row nopadding">
                        <div v-if="products.length">
                            <div class="col-sm-4" v-for="product in products">
                                <div class="product-shortcode style-1">
                                    <div class="title">
                                        <div class="simple-article size-1 color col-xs-b5"><a href="#">{{ category.name }}</a></div>
                                        <div class="h6 animate-to-green"><a href="#">{{ product.name }}</a></div>
                                    </div>
                                    <div class="preview">
                                        <img v-if="product.images.length" :src="product.images[0].url" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                                        <img v-else="!product.images.length" src="/img/customer/box.jpg" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                                        <div class="preview-buttons valign-middle">
                                            <div class="valign-middle-content open-popup" data-rel="ProductView" @click="setProductView(product)">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-md-pull-9">
            <div class="h4 col-xs-b10">categories</div>
            <ul class="categories-menu transparent">
                <category-tree :categories="categories"></category-tree>
            </ul>
        </div>
    </div>
    <div class="empty-space col-xs-b15 col-sm-b75"></div>
    <div class="empty-space col-xs-b15 col-sm-b75"></div>
    <div class="empty-space col-xs-b15 col-sm-b75"></div>
</div>
</template>
<script>
import CategoryTree from './Components/CategoryTree.vue';

export default {
    watch: {
        '$route' (to, from) {
            this.checkRoute(to);
        }
    },
    mounted() {
        var that = this;

        this.$root.$on('CategoryDataReceived', function(categories) {
            that.categories = categories;
        });

        this.$root.$on('ProductsOnCategoryDataReceived', function(products) {
            that.products = products;
        });

        this.$root.$on('ClickedCategory', function(category) {
            that.$root.$emit('ProductsOnCategoryDataRequested', category.id);
            that.category = category;
        });

        this.checkRoute(this.$route);
    },
    components: {
        CategoryTree
    },
    data: function() {
        return {
            category: {
                name: ''
            },
            categories: [],
            products: []
        }
    },
    methods: {
        setProductView: function(product) {
            this.$root.$emit('ProductViewSelected', product);
        },
        checkRoute: function(to) {
            this.$http.get('/api/categories/' + to.params.category_id).then((response) => {

                if (response.data.success) {
                    this.category = response.data.payload;
                    this.categories = this.category.children;
                    this.$root.$emit('ProductsOnCategoryDataRequested', to.params.category_id);
                }
            });
        }
    }
}
</script>
