<template>
<div>
    <form v-on:submit.prevent="submitBillingDetails()">
        <h4 class="h4 col-xs-b25">billing details</h4>
        <div class="alert alert-danger" v-if="error">
            <p>{{ error }}</p>
        </div>
        <div class="row m10">
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="First name" v-model="payload.firstname" />
                <div class="empty-space col-xs-b20"></div>
            </div>
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="Last name" v-model="payload.lastname" />
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
        <input class="simple-input" type="text" value="" placeholder="Company Name - OPTIONAL" v-model="payload.company" />
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Company VAT Number - OPTIONAL" v-model="payload.company_vat" />
        <div class="empty-space col-xs-b20"></div>
        <select billing-country-list>
       <option disabled="disabled" selected="selected">{{ countriesPlaceHolder}}</option>
       <option :value="country.id" v-for="country in countries">{{ country.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <select billing-region-list v-if="regions.length">
       <option disabled="disabled" selected="selected">{{ regionsPlaceHolder }}</option>
       <option :value="region.id" v-for="region in regions">{{ region.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <select billing-city-list v-if="cities.length">
       <option disabled="disabled" selected="selected">{{ citiesPlaceHolder }}</option>
       <option :value="city.id" v-for="city in cities">{{ city.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" v-model="payload.postcode" />
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Appartment/Block Number/Other" v-model="payload.building" />
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Street address" v-model="payload.street" />
        <div class="empty-space col-xs-b20"></div>
        <div class="row m10">
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="Email" v-model="payload.email" />
                <div class="empty-space col-xs-b20"></div>
            </div>
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="Phone" v-model="payload.phone" />
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
        <div class="row m10">
            <div class="col-sm-12">
                <div class="button block size-2 style-3">
                    <span class="button-wrapper">
                   <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                    <span class="text">Next</span>
                    </span>
                    <input type="submit" />
                </div>
            </div>
        </div>
    </form>
</div>
</template>
<script>
export default {
    props: [
        'state',
    ],
    mounted() {
        var that = this;

        this.$watch('countries', function() {
            that.initCountryComponent();
        });
        this.$watch('regions', function() {
            that.initRegionComponent();
        });
        this.$watch('cities', function() {
            that.initCityComponent();
        });

        this.$root.$on('CountriesDataReceived', function(countries) {
            that.countries = countries;
        });
        this.$root.$on('RegionsDataReceived', function(regions) {
            that.regions = regions;
        });
        this.$root.$on('CitiesDataReceived', function(cities) {
            that.cities = cities;
        });

        this.$root.$on('BillingDetailDataUpdateReceived', function(payload) {
            that.state.phase = 'shipping-address';
        });

        this.$root.$on('BillingDetailDataUpdateFailed', function(error) {
            that.showError(error.desc);
        });

        this.$root.$on('UserAuthDataReceived', function(user) {
            if (user != undefined) {
                if (user.billing_detail != undefined) {
                    that.payload.firstname = user.billing_detail.firstname;
                    that.payload.lastname = user.billing_detail.lastname;
                    that.payload.company = user.billing_detail.company;
                    that.payload.company_vat = user.billing_detail.company_vat;
                    that.payload.email = user.billing_detail.email;
                    that.payload.phone = user.billing_detail.phone;
                    that.payload.postcode = user.billing_detail.postcode;
                    that.payload.building = user.billing_detail.building;
                    that.payload.street = user.billing_detail.street;

                    that.countriesPlaceHolder = user.billing_detail.country;
                    that.regionsPlaceHolder = user.billing_detail.region;
                    that.citiesPlaceHolder = user.billing_detail.city;

                    that.initCountryComponent();
                    that.initRegionComponent();
                    that.initCityComponent();
                }
            }
        });

        this.$root.$emit('UserAuthDataRequested');
    },
    destroyed() {
        this.$root.$off('CountriesDataReceived');
        this.$root.$off('CitiesDataReceived');
        this.$root.$off('RegionsDataReceived');
        this.$root.$off('BillingDetailDataUpdateReceived');
    },
    data() {
        return {
            countries: [],
            regions: [],
            cities: [],
            countriesPlaceHolder: 'Select Country',
            regionsPlaceHolder: 'Select Region',
            citiesPlaceHolder: 'Select City',
            regionChangeRequested: false,
            cityChangeRequested: false,
            payload: {
                firstname: '',
                lastname: '',
                company: '',
                company_vat: '',
                email: '',
                phone: '',
                postcode: '',
                building: '',
                street: '',
                country_id: null,
                region_id: null,
                city_id: null,
            },
            error: false,
        }
    },
    methods: {
        submitBillingDetails: function() {
            this.$root.$emit('BillingDetailDataUpdateRequested', this.payload);
        },
        showError: function(message) {
            window.scrollTo(0, 0);
            this.error = message;
        },
        initCountryComponent: function() {
            var that = this;

            if (this.payload.country_id == null) {

                $('[billing-country-list]').SumoSelect({
                    search: true,
                    placeholder: that.countriesPlaceHolder,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[billing-country-list]').change(function(e) {
                    that.regionChangeRequested = true;
                    that.payload.country_id = e.target.value;
                    that.$root.$emit('RegionDataRequested', that.payload.country_id);
                });
            }

        },
        initRegionComponent: function() {
            var that = this;

            if (this.payload.region_id == null) {

                $('[billing-region-list]').SumoSelect({
                    search: true,
                    placeholder: that.regionsPlaceHolder,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[billing-region-list]').change(function(e) {
                    that.cityChangeRequested = true;
                    that.payload.region_id = e.target.value;
                    that.$root.$emit('CityDataRequested', that.payload.region_id);
                });
            } else {
                if (that.regionChangeRequested) {
                    that.regionChangeRequested = false;
                    that.region_id = -1;
                    $('[billing-region-list]')[0].sumo.reload();
                }
            }

        },
        initCityComponent: function() {
            var that = this;

            if (this.payload.city_id == null) {
                $('[billing-city-list]').SumoSelect({
                    search: true,
                    placeholder: that.citiesPlaceHolder,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[billing-city-list]').change(function(e) {
                    that.payload.city_id = e.target.value;
                });
            } else {
                if (that.cityChangeRequested) {
                    that.cityChangeRequested = false;
                    that.city_id = -1;
                    $('[billing-city-list]')[0].sumo.reload();
                }
            }

        }
    }
}
</script>
