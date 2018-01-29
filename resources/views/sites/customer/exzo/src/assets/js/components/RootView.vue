<template>
<div>
    <div class="loader" v-if="loader">
        <rise-loader :loading="true" color="#dd4d42" :size="size"></rise-loader>
    </div>
    <div id="loader-wrapper"></div>
    <div id="content-block">
        <page-header></page-header>
        <div class="container">
            <div class="empty-space col-xs-b35 col-md-b70"></div>
            <router-view></router-view>
        </div>
    </div>
    <page-footer></page-footer>
    <div class="popup-wrapper">
        <div class="bg-layer"></div>
        <product-view></product-view>
        <search-result-view></search-result-view>
    </div>
    <auth ref="auth"></auth>
    <store ref="store"></store>
</div>
</template>

<script>
import Store from './Shared/Storage.vue';
import Auth from './Shared/Auth.vue';

import PageHeader from './Shared/Header/HeaderView.vue';
import PageFooter from './Shared/Footer/FooterView.vue';
import ProductView from './Dashboard/Components/ProductView.vue';
import SearchResultView from './Dashboard/Components/SearchResultView.vue';
import RiseLoader from './../../../node_modules/vue-spinner/src/RiseLoader.vue'

export default {
    created() {
        var that = this;

        this.$root.$on('ShoppingCartDataRequested', function() {
            that.getShoppingCart();
        });

        this.$root.$on('CountryDataRequested', function() {
            that.getCountries();
        });

        this.$root.$on('RegionDataRequested', function(countryId) {
            that.getRegions(countryId);
        });

        this.$root.$on('CityDataRequested', function(regionId) {
            that.getCities(regionId);
        });

        this.$root.$on('ProductListDataRequested', function() {
            that.getProductList();
        });

        this.$root.$on('AddBasketProduct', function(product) {
            that.addBasketProduct(product);
        });

        this.$root.$on('CategoryDataRequested', function(product) {
            that.getCategories();
        });

        this.$root.$on('ProductsOnCategoryDataRequested', function(categoryId) {
            that.getProductsOnCategory(categoryId);
            //that.loader = !that.loader;
        });

        this.$root.$on('BillingDetailDataUpdateRequested', function(payload) {
            that.updateBillingData(payload);
        });

        this.$root.$on('UserAuthDataReceived', function(user) {
            that.setUserAuthData(user);
        });

        this.$root.$on('UserAuthDataRequested', function(user) {
            this.$root.$emit('UserAuthDataReceived', that.user);
        });
        this.$root.$on('ProductAvailabilityDataRequested', function(productId) {
            that.getProductAvailability(productId);
        });
        this.$root.$on('activateLoader',function(){
            that.loading();
        });
    },
    mounted() {
        this.getShoppingCart();
    },
    methods: {
        getCategories: function() {
            this.$http.get('/api/categories').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('CategoryDataReceived', response.data.payload);
                }
            });
        },
        getProductAvailability: function(productId){
          this.$http.get('/api/availability/'+ productId).then((response) => {
              if (response.data.success) {
                  this.$root.$emit('ProductAvailabilityDataReceived', response.data.payload);
              }
          });
        },
        getShoppingCart: function() {
            this.$http.get('/api/basket').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('ShoppingCartDataReceived', response.data.payload);
                }
            });
        },
        getProductList: function() {
            this.$http.get('/api/render/products').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('ProductListDataReceived', response.data.payload);
                }
            });
        },
        getProductsOnCategory: function(payload) {
            this.$http.get('/api/render/products/' + payload.catId+'?page='+payload.currentPage).then((response) => {
                if (response.data.success) {
                    //this.loader = !this.loader;
                    this.$root.$emit('ProductsOnCategoryDataReceived', response.data.payload);
                    
                }
            });
        },
        getCountries: function() {
            this.$http.get('/api/render/countries').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('CountriesDataReceived', response.data.payload);
                }
            });
        },
        getRegions: function(countryId) {
            this.$http.get('/api/render/regions/' + countryId).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('RegionsDataReceived', response.data.payload);
                }
            });
        },
        getCities: function(regionId) {
            this.$http.get('/api/render/cities/' + regionId).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('CitiesDataReceived', response.data.payload);
                }
            });
        },
        addBasketProduct: function(product) {
            this.$http.post('/api/basket', product).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('ShoppingCartDataReceived', response.data.payload);
                }
            });
        },
        updateBillingData: function(payload) {
            this.$http.post('/api/checkout/billing', payload).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('BillingDetailDataUpdateReceived', response.data.payload);
                } else {
                    this.$root.$emit('BillingDetailDataUpdateFailed', response.data.error);
                }
            });
        },
        setUserAuthData: function(user) {
            this.user = user;
        },
        loading: function(){
            this.loader = !this.loader;
        }
    },
    components: {
        PageHeader,
        PageFooter,
        ProductView,
        SearchResultView,
        Store,
        Auth,
        RiseLoader
    },
    data: function() {
        return {
            user: null,
            loader: false
        }
    }
}
</script>
<style>
    .loader {
        position: absolute;
        z-index: 200;
        background-color: #fff;
        width: 100vw;
        height: 200vw;
        line-height: 50vw;
        opacity: 0.8;
        
    }

    @media screen and (max-width: 780px) {
        .loader {
            line-height: 215vw;
            height: 300vw;

        }
    }

</style>
