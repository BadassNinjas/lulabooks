<template>
<div>
    <div class="row">
        <div class="col-md-6 col-xs-b30 col-md-b0">
            <div class="banner-shortcode style-6">
                <img class="image" src="/img/customer/buy_books.jpg" alt="">
                <div class="content">
                    <div class="cell-view">
                        <h4 class="title h4 col-xs-b5"><span class="color">BUY BOOKS</span> <br> FOR ALL YOUR SUBJECTS</h4>
                        <router-link class="button size-2 style-3" tag="a" :to="'/products/'+5">
                            <span class="button-wrapper">
                              <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                            <span class="text">BUY BOOKS</span>
                            </span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="banner-shortcode style-6">
                <img class="image" src="/img/customer/sell_books.jpg" alt="">
                <div class="content">
                    <div class="cell-view">
                        <h4 class="title h4 col-xs-b5"><span class="color">SELL BOOKS</span> <br> YOU NO LONGER NEED</h4>
                        <router-link class="button size-2 style-3" tag="a" to="/sell">
                            <span class="button-wrapper">
                              <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                            <span class="text">SELL BOOKS</span>
                            </span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <hr/>
        </div>
    </div>
    <product-grid></product-grid>
</div>
</template>

<script>
import ProductGrid from './Components/ProductGrid.vue';

export default {
    name: 'Home',
    metaInfo: {
        // title will be injected into parent titleTemplate
        title: 'Home | Lulabooks',
        meta: [
            { charset: 'utf-8' },
            { name: 'description', content: 'We sell new and second hand university textbooks at very low prices. Visit us now to view our selection' },
            { name: 'keywords', content: 'buy, sell, new, secondhand, textbooks, academic, university, sell your books, delivery, online payment' }

        ]
    },
    components: {
        ProductGrid,
    }
}
</script>
