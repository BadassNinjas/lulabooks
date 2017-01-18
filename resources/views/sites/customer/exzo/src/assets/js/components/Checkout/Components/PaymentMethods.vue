<template>
<div>

    <h4 class="h4 col-xs-b25">payment method</h4>
    <select payment-methods>
         <option selected="selected">Credit/Debit Card</option>
         <option value="volvo">Bank Transfer (EFT)</option>
     </select>
    <div class="empty-space col-xs-b10"></div>
    <div class="simple-article size-2">* For credit/debit card payments, you will be redirected to the addPay payment platform to perform continue payment. Once payment has been made, a confirmation email will be sent to you and you will be returned to LulaBooks.</div>
    <div class="empty-space col-xs-b30"></div>
    <textarea class="simple-input" placeholder="Do you have any notes or special requests for your order? Enter them here."></textarea>
    <div class="empty-space col-xs-b30"></div>
    <div class="button block size-2 style-3">

        <span class="button-wrapper">
             <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
        <span class="text">place order</span>
        </span>
        <input type="submit" />
    </div>
</div>
</template>

<script>
export default {
    mounted() {
        $('[payment-methods]').SumoSelect({
            search: false,
            floatWidth: 0
        });
    }
}
</script>
