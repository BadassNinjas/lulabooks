<template>
<div class="container">
    <div class="empty-space col-xs-b15 col-sm-b30"></div>
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <div class="align-inline spacing-1" v-if="Products.data.length">
                <div class="h4"><span v-if="category.parent">{{ category.parent.name }} &raquo; </span> {{ category.name }}</div>
            </div>
            <div class="align-inline spacing-1" v-else-if="Products.data.length == 0">
                <div class="h6 text-center" v-if="category">There are no items listed under {{ category.name }} specifically, select a sub-category on the left to explore this section.</div>
                <div class="h6 text-center" v-else-if="category == null">Select a category to browser by.</div>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="products-content">
                <div class="products-wrapper">
                    <div class="row nopadding">
                        <div v-if="Products.data.length">
                            <div class="col-sm-4 col-xs-6" v-for="product in Products.data">
                                <div class="product-shortcode style-1">
                                    <div class="title">
                                        <div class="simple-article size-1 color col-xs-b5"><a href="#">{{ category.name }}</a></div>
                                        <div class="h6 animate-to-green"><a href="#">{{ product.name }}</a></div>
                                    </div>
                                    <div class="preview">
                                        <img v-if="product.images.length" :src="product.images[0].path" alt="" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
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
            <vue-pagination  :pagination="Products"
                @paginate="getProducts()"
                :offset="4">
            </vue-pagination>
        </div>
        <div class="col-md-3 col-md-pull-9">
            <div class="h4 col-xs-b10">UWC Faculty Courses</div>
            <ul class="categories-menu transparent">
                <category-tree :categories="categories"></category-tree>
            </ul>
        </div>
    </div>
    
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
    <div class="empty-space col-xs-b50"></div>
</div>
</template>
<script>
import CategoryTree from './Components/CategoryTree.vue';
import VuePagination from './../Shared/Pagination.vue'
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
            that.Products = products;
        });

        this.$root.$on('ClickedCategory', function(category) {
            var payload = {
                catId: category.id,
                currentPage: 1
            }

            that.$root.$emit('ProductsOnCategoryDataRequested',payload);
            that.category = category;
        });

        this.checkRoute(this.$route);
    },
    components: {
        CategoryTree,
        VuePagination
    },
    data: function() {
        return {
            category: {
                name: ''
            },
            categories: [],
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
    methods: {
        getProducts() {
            window.scrollTo(0, 0);
            this.$http.get('/api/render/products/'+this.category.id+'?page='+this.Products.current_page).then((response) => {
                if (response.data.success) {
                    
                    this.Products = response.data.payload;
                }
            });
        },
        setProductView: function(product) {
            this.$root.$emit('ProductViewSelected', product);
        },
        checkRoute: function(to) {
            var that = this;

            if(to.params.category_id) {
                this.$http.get('/api/categories/' + to.params.category_id).then((response) => {

                    if (response.data.success) {
                        this.category = response.data.payload;
                        this.categories = this.category.children;

                        var payload = {
                            catId: to.params.category_id,
                            currentPage: that.Products.current_page
                        };

                        this.$root.$emit('ProductsOnCategoryDataRequested', payload);
                    }
                });
            } else {
                this.$http.get('/api/categories').then((response) => {
                    if (response.data.success) {
                        this.category = null;
                        this.categories = response.data.payload;
                    }
                });
            }
        }
    }
}
</script>
