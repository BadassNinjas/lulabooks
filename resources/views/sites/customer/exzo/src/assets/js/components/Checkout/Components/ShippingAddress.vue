<template>
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
    <input class="simple-input" type="text" value="" placeholder="Company name" />
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
</div>
</template>
<script>
export default {
    mounted() {
        var that = this;

        this.$watch('countries', function() {
            that.initCountryComponent();
        });

        this.$root.$on('CountriesDataReceived', function(countries) {
            that.countries = countries;
        });

        this.$root.$emit('CountryDataRequested');
    },
    data() {
        return {
            countries: [],
            regions: [],
            cities: [],
            payload: {}
        }
    },
    methods: {
        initCountryComponent: function() {
            $('[shipping-country-list]').SumoSelect({
                csvDispCount: 3,
                search: true,
                searchText: 'Search',
                noMatch: 'No matches for "{0}"',
                floatWidth: 0
            });
        }
    }
}
</script>
