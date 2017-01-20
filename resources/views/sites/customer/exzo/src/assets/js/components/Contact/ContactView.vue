<template>
<div class="container">
    <h4 class="h4 text-center col-xs-b25">Contact LulaBooks</h4>
    <div class="row">
        <div class="col-sm-4">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="/img/customer/exzo/icon-25.png" alt="">
                <div class="title h6">address</div>
                <div class="description simple-article size-2">ROBERT SOBUKWE ROAD, UWC, BELLVILLE</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="/img/customer/exzo/icon-23.png" alt="">
                <div class="title h6">phone</div>
                <div class="description simple-article size-2" style="line-height: 26px;">
                    <a href="tel:+27799479680">+27 79 947 9680</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="icon-description-shortcode style-1">
                <img class="icon" src="/img/customer/exzo/icon-28.png" alt="">
                <div class="title h6">email</div>
                <div class="description simple-article size-2"><a href="mailto:LUCKY@LULABOOKS.MOBI">LUCKY@LULABOOKS.MOBI</a></div>
            </div>
        </div>
    </div>
    <div class="empty-space col-xs-b50"></div>
    <h4 class="h4 text-center col-xs-b25">Or leave us a message and we'll contact you</h4>
    <div class="empty-space col-xs-b20"></div>
    <div v-if="success">
        <div class="empty-space col-xs-b50"></div>
        <h3 class="h3">
            Thank you! We have received your message and will respond accordingly soon!
        </h3>
        <div class="empty-space col-xs-b50"></div>
        <div class="empty-space col-xs-b50"></div>
        <div class="empty-space col-xs-b50"></div>
        <div class="empty-space col-xs-b50"></div>
    </div>
    <div class="empty-space col-xs-b20"></div>
    <form class="contact-form" v-on:submit.prevent="submitRequest()" v-if="!success">
        <div class="row" v-if="error">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <p>{{ error }}</p>
                </div>
            </div>
        </div>
        <div class="row">
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
                    <input class="simple-input" type="text" value="" placeholder="Email Address" v-model="payload.email" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Contact Number" v-model="payload.phone" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-12">
                    <textarea class="simple-input col-xs-b20" placeholder="Your message" name="message" v-model="payload.message"></textarea>
                </div>
            </div>
        </div>
        <div class="row m10">
            <div class="col-lg-4">
                <div class="button block size-2 style-3">
                    <span class="button-wrapper">
                 <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                    <span class="text">Submit</span>
                    </span>
                    <input type="submit" />
                </div>
            </div>
        </div>
    </form>
    <div class="empty-space col-xs-b50"></div>
</div>
</template>
<script>
export default {
    data: function() {
        return {
            payload: {
                firstname: '',
                lastname: '',
                phone: '',
                email: '',
                message: '',
            },
            success: false,
            error: false,
            result: false,
        }
    },
    methods: {
        submitRequest: function() {
            this.$http.post('/api/contact', this.payload).then((response) => {
                if (response.data.success) {
                    this.result = response.data.payload;
                    this.success = true;
                } else {
                    this.error = response.data.error.desc;
                }
            });
        }
    }
}
</script>
