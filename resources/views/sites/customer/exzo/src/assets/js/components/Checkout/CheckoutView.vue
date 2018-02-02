<template>
<div>
    <div class="container" style="padding-left: 0;">
        <div class="">
            <div class="h2">CHECKOUT</div>
            <div class="title-underline center" style="padding-left:15px;"><span></span></div>
        </div>
        <div class="row" style="padding-top:60px">
            <div class="col-md-6 col-xs-b50 col-md-b0">
                <div v-if="state.phase == 'check-auth'">
                    <h3 class="h3"><i class="fa fa-refresh fa-spin"></i> &nbsp;&nbsp; Checking auth...</h3>
                </div>
                <div v-if="state.phase == 'ask-auth'">
                    <h4 class="h4">You are logged in as <i>{{ user.email }}</i></h4>
                    <br/><br/>
                    <div class="button block size-2 style-3" @click="state.phase = 'billing-address'">
                        <span class="button-wrapper">
                     <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt="button"></span>
                        <span class="text">Continue as <b>{{ user.email }}</b></span>
                        </span>
                        <input type="button" />
                    </div>
                    <br/>
                    <div class="button block size-2 style-1 noshadow" @click="state.phase = 'pre-auth'">
                        <span class="button-wrapper">
                     <span class="icon"><i class="fa fa-arrow-right"></i></span>
                        <span class="text">Change User</span>
                        </span>
                        <input type="button" />
                    </div>
                </div>
                <pre-auth :state="state" v-show="state.phase == 'pre-auth'"></pre-auth>
                <billing-address :state="state" v-show="state.phase == 'billing-address'"></billing-address>
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
import OrderItems from './Components/OrderItems.vue';
import PaymentMethods from './Components/PaymentMethods.vue';
import PreAuth from './Components/PreAuth.vue';

export default {
    mounted() {
        var that = this;

        this.$watch('state.phase', function() {
            window.scrollTo(0, 0);
        });

        this.$http.get('/api/auth').then((response) => {
            setTimeout(function() {
                if (response.data.success) {
                    that.$root.$emit('UserAuthDataReceived', response.data.payload);
                    that.user = response.data.payload;
                    that.state.phase = 'ask-auth';
                } else {
                    that.state.phase = 'pre-auth';
                }
            }, 2000);
        });
    },
    components: {
        BillingAddress,
        OrderItems,
        PaymentMethods,
        PreAuth,
    },
    data: function() {
        return {
            state: {
                phase: 'check-auth'
            },
            preAuth: {
                email: false,
                password: false,
            },
            user: {}
        }
    }
}
</script>
