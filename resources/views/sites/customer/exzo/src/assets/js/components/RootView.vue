<template>
<div>
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

        <page-product-view></page-product-view>

    </div>
</div>
</template>

<script>
import PageHeader from './Shared/PageHeader.vue';
import PageFooter from './Shared/PageFooter.vue';
import PageProductView from './Shared/PageProductView.vue';

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
    },
    mounted() {
        this.getCategories();
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
        }
    },
    components: {
        PageHeader,
        PageFooter,
        PageProductView,
    }
}
</script>
