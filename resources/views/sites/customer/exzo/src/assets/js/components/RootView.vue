<template>
<div>
    <div id="loader-wrapper"></div>
    <div id="content-block">

        <page-header :ShoppingCart="ShoppingCart"></page-header>

        <div class="container">
            <div class="empty-space col-xs-b35 col-md-b70"></div>

            <router-view :RenderCategories="Categories" :RenderProducts="ContainerProducts"></router-view>
        </div>

    </div>

    <page-footer></page-footer>

    <div class="popup-wrapper">
        <div class="bg-layer"></div>

        <page-login></page-login>

        <page-register></page-register>

        <page-product-view></page-product-view>

    </div>
</div>
</template>

<script>
import PageHeader from './Shared/PageHeader.vue';
import PageSlider from './Shared/PageSlider.vue';
import PageFooter from './Shared/PageFooter.vue';
import PageLogin from './Shared/PageLogin.vue';
import PageRegister from './Shared/PageRegister.vue';
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
    },
    mounted() {
        this.getCategories();
        this.getDisplayProducts();
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
        getDisplayProducts: function() {
            this.$http.get('/api/render/products').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('ProductDisplayDataReceived', response.data.payload);
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
            this.$http.get('/api/render/regions/' + regionId).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('CityDataReceived', response.data.payload);
                }
            });
        },
    },
    components: {
        PageHeader,
        PageSlider,
        PageFooter,
        PageLogin,
        PageRegister,
        PageProductView,
    }
}
</script>
