<template>
<div>
    <div class="row">
        <div class="col-md-6 col-xs-b30 col-md-b0">
            <div class="banner-shortcode style-6">
                <img class="image" src="/img/customer/buy_books.jpg" alt="">
                <div class="content">
                    <div class="cell-view">
                        <h4 class="title h4 col-xs-b5"><span class="color">BUY BOOKS</span> <br> FOR ALL YOUR SUBJECTS</h4>
                        <div class="description simple-article size-2 col-xs-b10">Quisque rhoncus orci vitae nisl rutrum rutrum lesuada laoreet urna sed</div>
                        <div class="subtitle simple-article size-5 grey uppercase col-xs-b20">Don't miss! <span class="color">up to 70%</span></div>
                        <a class="button size-2 style-3" href="#">
                            <span class="button-wrapper">
                              <span class="icon"><img src="img/customer/exzo/icon-4.png" alt=""></span>
                            <span class="text">BUY BOOKS</span>
                            </span>
                        </a>
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
                        <div class="description simple-article size-2 col-xs-b10">Quisque rhoncus orci vitae nisl rutrum rutrum lesuada laoreet urna sed</div>
                        <div class="subtitle simple-article size-5 grey uppercase col-xs-b20">over <span class="color">150</span> models</div>
                        <a class="button size-2 style-3" href="#">
                            <span class="button-wrapper">
                                      <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                            <span class="text">SELL BOOKS</span>
                            </span>
                        </a>
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
    components: {
        ProductGrid,
    }
}
</script>
