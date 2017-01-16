<template>
<div>
    <header>
        <div class="header-top">
            <div class="content-margins">
                <div class="row">
                    <div class="col-md-5 hidden-xs hidden-sm">
                        <div class="entry"><b>contact us:</b> <a href="tel:+35235551238745">+3  (523) 555 123 8745</a></div>
                        <div class="entry"><b>email:</b> <a href="mailto:office@exzo.com">office@exzo.com</a></div>
                    </div>
                    <div class="col-md-7 col-md-text-right">
                        <div class="entry"><a class="open-popup" data-rel="1"><b>login</b></a>&nbsp; or &nbsp;<a class="open-popup" data-rel="2"><b>register</b></a></div>
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
        <nav-bar></nav-bar>
    </header>
    <div class="header-empty-space"></div>
</div>
</template>

<script>
import ShoppingCartWidget from './ShoppingCart/CartWidget.vue';
import NavBar from './Navigation/NavBar.vue';

export default {
    props: [
        'ShoppingCart'
    ],
    components: {
        ShoppingCartWidget,
        NavBar
    }
}
</script>
