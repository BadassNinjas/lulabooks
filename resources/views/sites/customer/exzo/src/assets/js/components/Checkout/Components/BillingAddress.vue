<template>
<div>
    <form v-on:submit.prevent="submitBillingDetails()">
        <h4 class="h4 col-xs-b25">Shipping details</h4>
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
        <div class="row m10">
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="Country" v-model="payload.country" />
                <div class="empty-space col-xs-b20"></div>
            </div>
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="State/Region" v-model="payload.region" />
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
        <div class="row m10">
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="City" v-model="payload.city" />
                <div class="empty-space col-xs-b20"></div>
            </div>
            <div class="col-sm-6">
                <input class="simple-input" type="text" value="" placeholder="Postcode/ZIP" v-model="payload.postcode" />
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
        <div class="row m10">
            <div class="col-sm-12">
                <input class="simple-input" type="text" value="" placeholder="Street address" v-model="payload.street" />
                <div class="empty-space col-xs-b20"></div>
            </div>
        </div>
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
    }
}
</script>
