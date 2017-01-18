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

                <billing-address></billing-address>

                <div class="empty-space col-xs-b50"></div>

                <shipping-address></shipping-address>

                <div class="empty-space col-xs-b30 col-sm-b60"></div>

                <textarea class="simple-input" placeholder="Note about your order"></textarea>
            </div>
            <div class="col-md-6">
                <order-items></order-items>
                <payment-methods></payment-methods>
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

export default {
    components: {
        BillingAddress,
        ShippingAddress,
        OrderItems,
        PaymentMethods,
    }
}
</script>
