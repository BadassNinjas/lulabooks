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

                <label class="checkbox-entry checkbox-toggle-title">
                     <input type="checkbox"><span>Deliver to a different address?</span>
                 </label>

                <shipping-address></shipping-address>

                <div class="empty-space col-xs-b30 col-sm-b60"></div>

                <textarea class="simple-input" placeholder="Note about your order"></textarea>
            </div>
            <div class="col-md-6">
                <h4 class="h4 col-xs-b25">your order</h4>
                <div class="cart-entry clearfix" v-for="item in ShoppingCart.items">
                    <a class="cart-entry-thumbnail" href="#">
                        <img :src="item.misc.image" alt="" v-if="!item.originalItem.images.length" width="64" height="64">
                        <img :src="item.originalItem.images[0].url" alt="" v-else="item.originalItem.images.length" width="64" height="64">
                    </a>
                    <div class="cart-entry-description">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="h6"><a href="#">{{ item.name }}</a></div>
                                        <div class="simple-article size-1">QUANTITY: {{ item.quantity }}</div>
                                    </td>
                                    <td>
                                        <div class="simple-article size-3 grey">R {{ (item.price) }} X{{ item.quantity }}</div>
                                        <div class="simple-article size-1">TOTAL: R {{ (item.price*item.quantity) }}</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            cart subtotal
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">R {{ ShoppingCart.total }}</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            shipping and handling
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">free shipping</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            order total
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">R {{ ShoppingCart.total }}</div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b50"></div>
                <h4 class="h4 col-xs-b25">payment method</h4>
                <select class="SlectBox">
                     <option selected="selected">PayPal</option>
                     <option value="volvo">Volvo</option>
                     <option value="saab">Saab</option>
                     <option value="mercedes">Mercedes</option>
                     <option value="audi">Audi</option>
                 </select>
                <div class="empty-space col-xs-b10"></div>
                <div class="simple-article size-2">* Etiam mollis tristique mi ac ultrices. Morbi vel neque eget lacus sollicitudin facilisis. Lorem ipsum dolor sit amet semper ante vehicula ociis natoq.</div>
                <div class="empty-space col-xs-b30"></div>
                <div class="button block size-2 style-3">
                    <span class="button-wrapper">
                         <span class="icon"><img src="img/icon-4.png" alt=""></span>
                    <span class="text">place order</span>
                    </span>
                    <input type="submit" />
                </div>
            </div>
        </div>
    </div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
</div>
</template>

<script>
import BillingAddress from './Components/BillingAddress.vue';
import ShippingAddress from './Components/ShippingAddress.vue';

export default {
    data() {
        return {
            ShoppingCart: {
                items: [],
                total: '0.00',
            }
        }
    },
    components: {
        BillingAddress,
        ShippingAddress,
    }
}
</script>
