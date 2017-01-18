<template>
<div class="entry hidden-xs hidden-sm cart">
    <a href="cart.html">
        <b class="hidden-xs">Shopping Cart</b>
        <span class="cart-icon">
               <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <span class="cart-label">{{ ShoppingCart.items.length }}</span>
        </span>
        <span class="cart-title hidden-xs">R {{ (ShoppingCart.total) }}</span>
    </a>
    <div class="cart-toggle hidden-xs hidden-sm">
        <div class="cart-overflow">
            <div class="cart-entry clearfix" v-for="item in ShoppingCart.items">
                <a class="cart-entry-thumbnail" href="#"><img :src="item.misc.image" alt="" style="width:60px;height:60px;" /></a>
                <div class="cart-entry-description">
                    <table>
                        <tr>
                            <td>
                                <div class="h6"><a href="#">{{ item.name }}</a></div>
                                <div class="simple-article size-1">QUANTITY: {{ item.quantity }}</div>
                            </td>
                            <td>
                                <div class="simple-article size-3">R {{ item.price }} X{{ item.quantity }}</div>
                                <div class="simple-article size-2"><b>R {{ (item.price * item.quantity).toFixed(2) }}</b></div>
                            </td>
                            <td>
                                <div class="simple-article size-3">X{{ item.quantity }}</div>
                            </td>
                            <td>
                                <div class="button-close" @click="ProductRemove(item.id)"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr/>
            </div>
        </div>

        <div class="row" v-if="ShoppingCart.items.length">
            <div class="empty-space col-xs-b40"></div>
            <div class="col-xs-6">
                <div class="cell-view empty-space col-xs-b50">
                    <div class="simple-article size-5 grey">TOTAL <span class="color"><b>R{{ ShoppingCart.total }}</b></span></div>
                </div>
            </div>
            <div class="col-xs-6 text-right">
                <router-link tag="a" class="button size-2 style-3" to="/checkout">
                    <span class="button-wrapper">
                           <span class="icon"><img src="img/customer/exzo/icon-4.png" alt=""></span>
                    <span class="text">proceed to checkout</span>
                    </span>
                </router-link>
            </div>
        </div>
        <div class="row" v-else-if="!ShoppingCart.items.length">
            <div class="col-xs-12">
                <div class="cell-view empty-space col-xs-b50">
                    <div class="simple-article size-5 grey">There are no products in your shopping cart.</div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style>
.cart-entry {
    background: transparent;
    padding: 0 30px
}

.cart-entry-thumbnail {
    margin-top: 13px;
}
</style>

<script>
export default {
    props: [
        'ShoppingCart',
    ],
    methods: {
        ProductRemove: function(id) {
            this.$http.delete('/api/basket/' + id).then((response) => {
                if (response.data.success) {
                    this.$root.$emit('ShoppingCartDataReceived', response.data.payload);
                }
            });
        },
    }
}
</script>
