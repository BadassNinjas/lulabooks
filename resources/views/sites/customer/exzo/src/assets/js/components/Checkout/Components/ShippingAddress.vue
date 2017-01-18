<template>
<div>
    <h4 class="h4 col-xs-b25">delivery details</h4>
    <label class="checkbox-entry checkbox-toggle-title">
       <input type="checkbox" @click="deliveryDetailDiffers = !deliveryDetailDiffers"><span>Same as Billing Detail?</span>
   </label>
    <div class="empty-space col-xs-b20"></div>
    <div v-show="deliveryDetailDiffers">
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
        <input class="simple-input" type="text" value="" placeholder="Company name" v-model="payload.company" />
        <div class="empty-space col-xs-b20"></div>
        <select shipping-country-list>
       <option disabled="disabled" selected="selected">Choose country</option>
       <option :value="country.id" v-for="country in countries">{{ country.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <select shipping-region-list v-if="regions.length">
       <option disabled="disabled" selected="selected">Choose region</option>
       <option :value="region.id" v-for="region in regions">{{ region.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <select shipping-city-list v-if="cities.length">
       <option disabled="disabled" selected="selected">Choose Town/City</option>
       <option :value="city.id" v-for="city in cities">{{ city.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" v-model="payload.postal_code" />
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Appartment/Block Number/Other" v-model="payload.block_number" />
        <div class="empty-space col-xs-b20"></div>
        <input class="simple-input" type="text" value="" placeholder="Street address" v-model="payload.address" />
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
    </div>
    <div class="row m10">
        <div class="col-sm-12">
            <div class="button block size-2 style-3" @click="state.phase = 'payment-methods'">
                <span class="button-wrapper">
                   <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                <span class="text">Next</span>
                </span>
                <input type="submit" />
            </div>
        </div>
    </div>

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

        this.$root.$emit('CountryDataRequested');
    },
    data() {
        return {
            deliveryDetailDiffers: true,
            countries: [],
            regions: [],
            cities: [],
            regionChangeRequested: false,
            cityChangeRequested: false,
            payload: {
                firstname: '',
                lastname: '',
                country_id: null,
                region_id: null,
                city_id: null,
            }
        }
    },
    methods: {
        initCountryComponent: function() {
            var that = this;

            if (this.payload.country_id == null) {

                $('[shipping-country-list]').SumoSelect({
                    search: true,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[shipping-country-list]').change(function(e) {
                    that.regionChangeRequested = true;
                    that.payload.country_id = e.target.value;
                    that.$root.$emit('RegionDataRequested', that.payload.country_id);
                });
            }

        },
        initRegionComponent: function() {
            var that = this;

            if (this.payload.region_id == null) {

                $('[shipping-region-list]').SumoSelect({
                    search: true,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[shipping-region-list]').change(function(e) {
                    that.cityChangeRequested = true;
                    that.payload.region_id = e.target.value;
                    that.$root.$emit('CityDataRequested', that.payload.region_id);
                });
            } else {
                if (that.regionChangeRequested) {
                    that.regionChangeRequested = false;
                    that.region_id = -1;
                    $('[shipping-region-list]')[0].sumo.reload();
                }
            }

        },
        initCityComponent: function() {
            var that = this;

            if (this.payload.city_id == null) {
                $('[shipping-city-list]').SumoSelect({
                    search: true,
                    searchText: 'Search',
                    noMatch: 'No matches for "{0}"',
                    floatWidth: 0
                });

                $('[shipping-city-list]').change(function(e) {
                    that.payload.city_id = e.target.value;
                });
            } else {
                if (that.cityChangeRequested) {
                    that.cityChangeRequested = false;
                    that.city_id = -1;
                    $('[shipping-city-list]')[0].sumo.reload();
                }
            }

        }
    }
}
</script>
