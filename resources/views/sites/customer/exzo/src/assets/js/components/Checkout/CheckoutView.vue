<template>
<div>
    <div class="container">
        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">checkout</div>
            <div class="h2">check your info</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-xs-b50 col-md-b0">
                <h4 class="h4 col-xs-b25">billing details</h4>

                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input" type="text" value="" placeholder="First name" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input" type="text" value="" placeholder="Last name" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>

                <input class="simple-input" type="text" value="" placeholder="Company name" />

                <div class="empty-space col-xs-b20"></div>

                <select billing-country-list>
                     <option disabled="disabled" selected="selected">Choose country</option>
                     <option :value="country.id" v-for="country in BillingCountries" v-on:change="onBillingCountrySelect()">{{ country.name }}</option>
                 </select>

                <div class="empty-space col-xs-b20"></div>

                <select billing-region-list v-if="BillingRegions.length">
                     <option disabled="disabled" selected="selected">Choose region</option>
                     <option :value="region.id" v-for="region in BillingRegions">{{ region.name }}</option>
                 </select>

                <div class="empty-space col-xs-b20"></div>

                <select billing-city-list v-if="BillingCities.length">
                     <option disabled="disabled" selected="selected">Choose Town/City</option>
                     <option :value="city.id" v-for="city in BillingCities">{{ city.name }}</option>
                 </select>

                <div class="empty-space col-xs-b20"></div>

                <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" />

                <div class="empty-space col-xs-b20"></div>

                <input class="simple-input" type="text" value="" placeholder="Appartment/Block Number/Other" />

                <div class="empty-space col-xs-b20"></div>

                <input class="simple-input" type="text" value="" placeholder="Street address" />

                <div class="empty-space col-xs-b20"></div>

                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input" type="text" value="" placeholder="Email" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input" type="text" value="" placeholder="Phone" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>

                <div class="empty-space col-xs-b50"></div>

                <label class="checkbox-entry checkbox-toggle-title">
                     <input type="checkbox"><span>Deliver to a different address?</span>
                 </label>
                <div class="checkbox-toggle-wrapper">
                    <div class="empty-space col-xs-b25"></div>
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="First name" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Last name" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                    <select country-list>
                         <option disabled="disabled" selected="selected">Choose country</option>
                         <option :value="country.name" v-for="country in Countries">{{ country.name }}</option>
                     </select>
                    <div class="empty-space col-xs-b20"></div>

                    <input class="simple-input" type="text" value="" placeholder="Company name" />
                    <div class="empty-space col-xs-b20"></div>
                    <input class="simple-input" type="text" value="" placeholder="Street address" />
                    <div class="empty-space col-xs-b20"></div>
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Appartment" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Town/City" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="State/Country" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b30 col-sm-b60"></div>
                <textarea class="simple-input" placeholder="Note about your order"></textarea>
            </div>
            <div class="col-md-6">
                <h4 class="h4 col-xs-b25">your order</h4>
                <div class="cart-entry clearfix" v-for="item in ShoppingCart.items">
                    <a class="cart-entry-thumbnail" href="#">
                        <img :src="item.misc.image" alt="" v-if="!item.originalItem.images" width="64" height="64">
                        <img :src="item.originalItem.images[0].url" alt="" v-else="item.originalItem.images.length" width="64" height="64">
                    </a>
                    <div class="cart-entry-description">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="h6"><a href="#">{{ item.name }}</a></div>
                                        <div class="simple-article size-1">QUANTITY: {{ item.quantity }}</div>
                                    </td>
                                    <td>
                                        <div class="simple-article size-3 grey">R {{ (item.price) }} X{{ item.quantity }}</div>
                                        <div class="simple-article size-1">TOTAL: R {{ (item.price*item.quantity) }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            cart subtotal
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">R {{ ShoppingCart.total }}</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            shipping and handling
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">free shipping</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            order total
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">R {{ ShoppingCart.total }}</div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b50"></div>
                <h4 class="h4 col-xs-b25">payment method</h4>
                <select class="SlectBox">
                     <option selected="selected">PayPal</option>
                     <option value="volvo">Volvo</option>
                     <option value="saab">Saab</option>
                     <option value="mercedes">Mercedes</option>
                     <option value="audi">Audi</option>
                 </select>
                <div class="empty-space col-xs-b10"></div>
                <div class="simple-article size-2">* Etiam mollis tristique mi ac ultrices. Morbi vel neque eget lacus sollicitudin facilisis. Lorem ipsum dolor sit amet semper ante vehicula ociis natoq.</div>
                <div class="empty-space col-xs-b30"></div>
                <div class="button block size-2 style-3">
                    <span class="button-wrapper">
                         <span class="icon"><img src="img/icon-4.png" alt=""></span>
                    <span class="text">place order</span>
                    </span>
                    <input type="submit" />
                </div>
            </div>
        </div>
    </div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
</div>
</template>

<script>
export default {
    mounted() {
        var that = this;

        this.$root.$on('ShoppingCartDataReceived', function(ShoppingCart) {
            that.ShoppingCart = ShoppingCart;
        });

        this.$root.$emit('ShoppingCartDataRequested');

        this.$root.$on('WorldCountriesdataReceived', function(Countries) {
            that.BillingCountries = Countries;
            that.ShippingCountries = Countries;

            setTimeout(function() {
                $('[billing-country-list]').SumoSelect({
                    csvDispCount: 3,
                    search: true,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                // Work around for using SumoSelect with VueJS
                $('[billing-country-list]').change(function(e) {
                    that.onBillingCountrySelected(e);
                });

            }, 100);
        });

        this.getWorldCountries();
    },
    data() {
        return {
            ShoppingCart: {
                items: [],
                total: '0.00',
            },
            BillingCountries: [],
            BillingRegions: [],
            BillingCities: [],
            ShippingCountries: [],
            ShippingRegions: [],
            ShippingCities: [],
        }
    },
    methods: {
        getWorldCountries: function() {
            this.$http.get('/api/render/countries').then((response) => {
                if (response.data.success) {
                    this.$root.$emit('WorldCountriesdataReceived', response.data.payload);
                }
            });
        },
        onBillingCountrySelected: function(event) {
            var that = this;
            var countryId = event.target.value;

            this.$http.get('/api/render/regions/' + countryId).then((response) => {
                if (response.data.success) {
                    that.BillingRegions = response.data.payload;

                    setTimeout(function() {
                        $('[billing-region-list]').SumoSelect({
                            csvDispCount: 3,
                            search: true,
                            searchText: 'Search',
                            noMatch: 'No matches for "{0}"',
                            floatWidth: 0
                        });

                        $('[billing-region-list]')[0].sumo.reload();

                        $('[billing-region-list]').change(function(e) {
                            that.onBillingRegionSelected(e);
                        });

                    }, 100);
                }
            });
        },
        onBillingRegionSelected: function(event) {
            var that = this;
            var regionId = event.target.value;

            this.$http.get('/api/render/cities/' + regionId).then((response) => {
                if (response.data.success) {
                    that.BillingCities = response.data.payload;

                    setTimeout(function() {
                        $('[billing-city-list]').SumoSelect({
                            csvDispCount: 3,
                            search: true,
                            searchText: 'Search',
                            noMatch: 'No matches for "{0}"',
                            floatWidth: 0
                        });

                        $('[billing-city-list]')[0].sumo.reload();

                        $('[billing-city-list]').change(function(e) {
                            that.onBillingCitySelected(e);
                        });

                    }, 100);
                }
            });
        },
        onBillingCitySelected: function(event) {
            var that = this;
            var cityId = event.target.value;
        }
    }
}
</script>
