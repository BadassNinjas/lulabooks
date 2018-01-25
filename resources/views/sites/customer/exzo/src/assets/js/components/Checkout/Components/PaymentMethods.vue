<template>
<div>
    <div v-if="!complete">
        <h4 class="h4 col-xs-b25" >payment method</h4>
        <small class="simple-article size-2" style="padding-bottom: 15px;">Select Payment Method on the dropdown below</small><br>
        <small class="simple-article size-2 text-info" style="padding-bottom: 15px;color:#2ECC71"><i class="fa fa-info-circle" aria-hidden="true" ></i>&nbsp;Please note we accept Cash on Delivery when you select the offline payment option</small>
        <br>
        <small class="simple-article size-2 text-info" style="padding-bottom: 15px;color:#2ECC71"><i class="fa fa-info-circle" aria-hidden="true" ></i>&nbsp;This site is Encrypted with SSL, Your card and personal details are safe with us</small>
        <br>
        <br>
        <select class="form-control simple-input" v-model="payment_method">
          <option :value="method.method" v-for="method in availablePaymentMethods">{{ method.display_name }}</option>
     </select>
        <div class="empty-space col-xs-b10"></div>
        <div class="simple-article size-2">* For credit/debit card payments, you will be redirected to the addPay payment platform to perform continue payment. Once payment has been made, a confirmation email will be sent to you and you will be returned to LulaBooks.</div>
        <div class="empty-space col-xs-b30"></div>
        <textarea class="simple-input" placeholder="Do you have any notes or special requests for your order? Enter them here."></textarea>
        <div class="empty-space col-xs-b30"></div>
        <label class="checkbox-entry">
          <input type="checkbox" v-model="shipping">
          <span> Shipping Required?</span>
          <div class="simple-article size-1">*if you live Anywhere else besides UWC you need to tick this box. Shipping costs an additional R70</div>
        </label>
        <div class="empty-space col-xs-b30"></div>
        <label class="checkbox-entry">
          <input type="checkbox" v-model="agreeToTerms">

          <span > 
              Agree to 
              <a href="docs/terms-and-conditions.pdf" alt="terms and conditions document" style="color:#fc0000">
                <strong>Terms & Conditions</strong>
              </a>
          </span>
        </label>

        <div class="empty-space col-xs-b30"></div>
        <div v-if="agreeToTerms" class="button block size-2 style-3" style="transition:background-color 2s ease" @click="postPaymentPrepare()">
            <span class="button-wrapper">
             <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
            <span class="text">place order</span>
            </span>
            <input type="submit" />
        </div>
        <div v-else style="text-align: center;" >
            <small class="simple-article size-2" style="transition:color 2s ease"><b>Agree to terms and conditions to complete order</b></small>
            <div class="empty-space col-xs-b30"></div>
            <div class="button block size-2 style-3 disabled" style="transition:background-color 2s ease" @click="postPaymentPrepare()">
           
            <span class="button-wrapper">
             <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
            <span class="text">place order</span>
            </span>
            <input type="submit" />
        </div>
        </div>
        
    </div>
    <div v-if="complete">
        <div class="alert alert-success">
            <p>{{ complete }}</p>
        </div>
    </div>
</div>
</template>

<script>
export default {
    created() {
        this.getPaymentMethods();
        
    },
    mounted() {
        console.log(this.availablePaymentMethods);
    },
    data: function() {
        return {
            availablePaymentMethods: [],
            payment_method: '',
            complete: false,
            agreeToTerms: false,
            shipping: false,
        }

    },
    methods: {
        getPaymentMethods: function() {
            this.$http.get('/api/payment/methods').then((response) => {
                this.availablePaymentMethods = response.data;
            });
        },
        postPaymentPrepare: function() {
            this.$http.get('/api/payment/prepare/' + this.payment_method + '/' + this.shipping).then((response) => {
                if (response.data.method != 'METH_PAYMENT_BANK_TRANSFER') {
                    location.href = response.data.status.redirect;
                } else {
                    this.complete = 'Thank you, an email has been sent to you as confirmation of your order. Please follow the directions within the email sent to ' + response.data.payer.email +
                        ' in order to complete your transaction.';
                }
            });
        }
    }
}
</script>
