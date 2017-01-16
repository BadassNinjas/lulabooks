<template>
<div class="entry hidden-xs hidden-sm cart">
    <a href="cart.html">
        <b class="hidden-xs">Shopping Cart</b>
        <span class="cart-icon">
               <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <span class="cart-label">{{ ShoppingCart.items.length }}</span>
        </span>
        <span class="cart-title hidden-xs">R{{ ShoppingCart.total }}</span>
    </a>
    <div class="cart-toggle hidden-xs hidden-sm">
        <div class="cart-overflow">
            <div class="cart-entry clearfix" v-for="item in ShoppingCart.items" v-if="ShoppingCart.items.length">
                <a class="cart-entry-thumbnail" href="#"><img :src="item.misc.image" alt="" style="width:60px;height:60px;"/></a>
                <div class="cart-entry-description">
                    <table>
                        <tr>
                            <td>
                                <div class="h6"><a href="#">{{ item.name }}</a></div>
                                <div class="simple-article size-1">QUANTITY: {{ item.quantity }}</div>
                            </td>
                            <td>
                                <div class="simple-article size-3 grey">R {{ item.price }}</div>
                                <div class="simple-article size-1">R {{ (item.price * item.quantity).toFixed(2) }}</div>
                            </td>
                            <td>
                                <div class="cart-color" style="background: #eee;"></div>
                            </td>
                            <td>
                                <div class="button-close" @click="RemoveFromBasket(item.id)"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="empty-space col-xs-b40"></div>
        <div class="row">
            <div class="col-xs-6">
                <div class="cell-view empty-space col-xs-b50">
                    <div class="simple-article size-5 grey">TOTAL <span class="color">R{{ ShoppingCart.total }}</span></div>
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
    </div>
</div>
</template>

<script>
export default {
    mounted() {
        var that = this;

        this.$root.$on('ShoppingCartDataReceived', function(ShoppingCart) {
            that.ShoppingCart = ShoppingCart;
        });
        //alert(that.ShoppingCart.items[1]);
    },
    data() {
        return {
            ShoppingCart: {
                items: [],
                total: '0.00',
            },
        }
    },
    methods: {
        RemoveFromBasket: function(productId) {
            var that = this;
            that.$parent.$parent.removeFromBasket(productId);
        }
    }
}
</script>
