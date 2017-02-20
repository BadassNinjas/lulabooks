<template>
<div>
    <header>
        <div class="header-top">
            <div class="content-margins">
                <div class="row">
                    <div class="col-md-5 hidden-xs hidden-sm">
                        <div class="entry"><b>contact us:</b> <a href="tel:+27799479680">+27 79 947 9680</a></div>
                        <div class="entry"><b>email:</b> <a href="mailto:info@lulabooks.mobi">info@lulabooks.mobi</a></div>
                    </div>
                    <div class="col-md-7 col-md-text-right">
                        <div class="entry language">
                            <div class="title"><b>ZAR</b></div>
                            <div class="language-toggle header-toggle-animation">
                                <a href="/">ZAR</a>
                            </div>
                        </div>
                        <shopping-cart :ShoppingCart="ShoppingCart"></shopping-cart>
                        <div class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <navigation-bar :ShoppingCart="ShoppingCart"></navigation-bar>
    </header>
    <div class="header-empty-space"></div>
</div>
</template>

<script>
import ShoppingCart from './Components/ShoppingCart.vue';
import NavigationBar from './Components/NavigationBar.vue';

export default {
    mounted() {
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
                total: 0,
            },
        }
    },
    components: {
        ShoppingCart,
        NavigationBar
    }
}
</script>
