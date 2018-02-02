<template>
<div>
    <h4 class="h4 col-xs-b25">your order</h4>
    <div class="cart-entry clearfix" v-for="item in ShoppingCart.items">
        <a class="cart-entry-thumbnail" href="#">
            <img :src="item.misc.image" alt="product-image" v-if="!item.originalItem.images.length" width="64" height="64">
            <img :src="item.originalItem.images[0].path" alt="product-img" v-else="item.originalItem.images.length" width="64" height="64">
        </a>
        <div class="cart-entry-description">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div class="h6"><a href="#">{{ item.name }}</a></div>
                            <div class="simple-article size-1">QUANTITY: {{ item.quantity }}</div>
                            <div v-if="item.grade === '0.9'" class="simple-article size-1">Grade: A-GRADE </div>
                            <div v-else-if ="item.grade === '0.85'" class="simple-article size-1">Grade: B-GRADE </div>
                            <div v-else class="simple-article size-1">Grade: New </div>
                        </td>
                        
                        <td>
                            <div class="simple-article size-3 grey">R {{ (item.price*item.grade).toFixed(2) }} X{{ item.quantity }}</div>
                            <div class="simple-article size-1">TOTAL: R {{ (item.price*(item.quantity*item.grade)).toFixed(2) }}</div>
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
                <div class="color">R {{ (ShoppingCart.total).toFixed(2) }}</div>
            </div>
        </div>
    </div>
    <div class="order-details-entry simple-article size-3 grey uppercase">
        <div class="row">
            <div class="col-xs-6">
                shipping and handling
            </div>
            <div class="col-xs-6 col-xs-text-right">
                <div class="color" v-if="shipping">R70</div>
                <div class="color" v-else >R0</div>
            </div>
        </div>
    </div>
    <div class="order-details-entry simple-article size-3 grey uppercase">
        <div class="row">
            <div class="col-xs-6">
                order total
            </div>
            <div class="col-xs-6 col-xs-text-right">
                <div class="color" v-if="shipping">R {{ (ShoppingCart.total+70).toFixed(2) }}</div>
                <div class="color" v-else >R {{ (ShoppingCart.total).toFixed(2) }}</div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    created() {
        var that = this;

        this.$root.$on('ShoppingCartDataReceived', function(ShoppingCart) {
            that.ShoppingCart = ShoppingCart;
        });
        this.$root.$emit('ShoppingCartDataRequested');

        this.$root.$on('ShippingRequired', function(ShoppingCart) {
            that.shipping = !that.shipping;
        });

    },
    data() {
        return {
            ShoppingCart: {
                items: [],
                total: '0.00',
            },
            shippingPrice: 70,
            shipping: false
        }
    },
}
</script>
