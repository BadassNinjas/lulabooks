<template>
<div>
    <header>
        <div class="header-top">
            <div class="content-margins">
                <div class="row">
                    <div class="col-md-5 hidden-xs hidden-sm">
                        <div class="entry"><b>contact us:</b> <a href="tel:+27799479680">+27 79 947 9680</a></div>
                        <div class="entry"><b>email:</b> <a href="mailto:lucky@lulabooks.mobi">lucky@lulabooks.mobi</a></div>
                    </div>
                    <div class="col-md-7 col-md-text-right">
                        <div class="entry language">
                            <div class="title"><b>ZAR</b></div>
                            <div class="language-toggle header-toggle-animation">
                                <a href="index1.html">ZAR</a>
                            </div>
                        </div>
                        <shopping-cart-widget :ShoppingCart="ShoppingCart"></shopping-cart-widget>
                        <div class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <navigation-bar></navigation-bar>
    </header>
    <div class="header-empty-space"></div>
</div>
</template>

<script>
import ShoppingCartWidget from './ShoppingCart/CartWidget.vue';
import NavigationBar from './NavigationBar.vue';

export default {
    props: [
        'ShoppingCart'
    ],
    components: {
        ShoppingCartWidget,
        NavigationBar
    }
}
</script>
