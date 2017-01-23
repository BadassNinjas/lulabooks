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
        <select v-model="payload.country" class="form-control simple-input">
           <option :value="country.name" v-for="country in countries" :selected="country.name == payload.country">{{ country.name }}</option>
       </select>
        <div class="empty-space col-xs-b20"></div>
        <select v-model="payload.region" v-if="regions.length || payload.region" class="form-control simple-input">
           <option :value="region.name" v-for="region in regions" :selected="region.name == payload.region">{{ region.name }}</option>
       </select>
        <div class="empty-space col-xs-b20"></div>
        <select v-model="payload.city" v-if="cities.length || payload.city" class="form-control simple-input">
           <option :name="city.name" :value="city.id" v-for="city in cities" :selected="city.name == payload.city">{{ city.name }}</option>
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

        this.$root.$on('BillingDetailDataUpdateReceived', function(payload) {
            that.state.phase = 'payment-methods';
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
                    that.payload.country = user.billing_detail.country;
                    that.payload.city = user.billing_detail.city;
                    that.payload.region = user.billing_detail.region;
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
                country: '',
                region: '',
                city: '',
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
