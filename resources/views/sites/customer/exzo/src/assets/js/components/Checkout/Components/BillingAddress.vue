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
        <select v-on:change="countryChanged" class="form-control simple-input">
           <option :value="country.id" v-for="country in countries" >{{ country.name }}</option>
       </select>
        <div class="empty-space col-xs-b20"></div>
        <select v-on:change="regionChanged" v-if="regions.length" class="form-control simple-input">
       <option :value="region.id" v-for="region in regions">{{ region.name }}</option>
   </select>
        <div class="empty-space col-xs-b20"></div>
        <select v-on:change="cityChanged" t v-if="cities.length" class="form-control simple-input">
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

        this.$watch('payload.country_id', function(nVal, oVal) {
            if (nVal != oVal) {
                that.getRegions(that.payload.country_id);
            }
        });

        this.$watch('payload.region_id', function() {
            that.getCities(that.payload.region_id);
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
                }
            }
        });

        this.$root.$emit('UserAuthDataRequested');
        this.getCountries();
    },
    data() {
        return {
            countries: [],
            regions: [],
            cities: [],
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
                country_id: '',
                region_id: '',
                city_id: '',
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
        countryChanged: function(e) {
            this.payload.country_id = e.target.value;
        },
        regionChanged: function(e) {
            this.payload.region_id = e.target.value;
        },
        cityChanged: function(e) {
            this.payload.city_id = e.target.value;
        },
        getCountries: function() {
            this.$http.get('/api/render/countries').then((response) => {
                if (response.data.success) {
                    this.countries = response.data.payload;
                }
            });
        },
        getRegions: function(countryId) {
            this.$http.get('/api/render/regions/' + countryId).then((response) => {
                if (response.data.success) {
                    this.regions = response.data.payload;
                }
            });
        },
        getCities: function(regionId) {
            this.$http.get('/api/render/cities/' + regionId).then((response) => {
                if (response.data.success) {
                    this.cities = response.data.payload;
                }
            });
        },
    }
}
</script>
