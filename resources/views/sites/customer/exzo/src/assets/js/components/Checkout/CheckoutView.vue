<template>
<div>
    <div class="container">
        <div class="text-center">
            <div class="h2">CHECKOUT</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-xs-b50 col-md-b0">
                <pre-auth :state="state" v-show="state.phase == 'pre-auth'"></pre-auth>
                <billing-address :state="state" v-show="state.phase == 'billing-address'"></billing-address>
                <!-- <shipping-address :state="state" v-show="state.phase == 'shipping-address'"></shipping-address> -->
                <payment-methods :state="state" v-show="state.phase == 'payment-methods'"></payment-methods>
            </div>
            <div class="col-md-6">
                <order-items></order-items>

            </div>
        </div>
    </div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
</div>
</template>

<script>
import BillingAddress from './Components/BillingAddress.vue';
import ShippingAddress from './Components/ShippingAddress.vue';
import OrderItems from './Components/OrderItems.vue';
import PaymentMethods from './Components/PaymentMethods.vue';
import PreAuth from './Components/PreAuth.vue';

export default {
    mounted() {
        this.$watch('state.phase', function() {
            window.scrollTo(0, 0);
        });
    },
    components: {
        BillingAddress,
        ShippingAddress,
        OrderItems,
        PaymentMethods,
        PreAuth,
    },
    data: function() {
        return {
            state: {
                phase: 'pre-auth'
            },
            preAuth: {
                email: false,
                password: false,
            }
        }
    }
}
</script>
