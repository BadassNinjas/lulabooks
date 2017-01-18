<template>
<div>
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
    },
    data() {
        return {
            ShoppingCart: {
                items: [],
                total: '0.00',
            }
        }
    },
}
</script>
