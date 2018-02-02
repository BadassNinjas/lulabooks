<template>
<div>
    <div class="popup-content" data-rel="SearchResultView">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="h4">Search Results</h4>
                    </div>
                </div>
                <div class="row" v-if="results.results">
                    <div class="col-sm-4" v-for="product in results.results">
                        <div class="product-shortcode style-1">
                            <div class="title">
                                <div class="simple-article size-1 color col-xs-b5"><a href="#">{{ product.category != null ? product.category.name : 'Uncategorized' }}</a></div>
                                <div class="h6 animate-to-green"><a href="#">{{ product.name }}</a></div>
                            </div>
                            <div class="preview">
                                <img v-if="product.images.length" :src="product.images[0].path" alt="product-image" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                                <img v-else="!product.images.length" src="/img/box.png" alt="product-img" class="img img-responsive" style="min-height: 100px; max-height: 100px;">
                                <div class="preview-buttons valign-middle">
                                    <div class="valign-middle-content open-popup" data-rel="ProductView" @click="setProductView(product)">
                                        <a class="button size-2 style-3" href="#">
                                            <span class="button-wrapper">
                                                    <span class="icon"><img src="/img/customer/exzo/icon-1.png" alt="product-image"></span>
                                            <span class="text">More Information</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="price">
                                <div class="simple-article size-4"><span class="color">R{{ product.price}}</span></div>
                            </div>
                            <div class="description">
                                <div class="simple-article text size-2">{{ product.caption }}</div>
                            </div>
                        </div>
                        <div class="empty-space col-xs-b35 col-md-b20"></div>
                    </div>
                </div>
                <div class="row" v-show="results.results && results.results.length == 0">
                    <div class="col-sm-12">
                        <h6 class="h6">No results found for search term '{{results.term}}'.</h6>
                    </div>
                </div>
            </div>
            <div class="button-close" @click="DismissView()"></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    created() {
        var that = this;

        this.$root.$on('SearchResultsReturned', function(results) {
            that.results = results;
            that.showView();
        });
    },
    data() {
        return {
            results: {}
        }
    },
    methods: {
        setProductView: function(product) {
            this.$root.$emit('ProductViewSelected', product);
        },
        DismissView: function() {
            if ($('.video-popup').hasClass('active')) {
                $('.video-popup .popup-iframe').html('');
            }

            $('.popup-wrapper, .popup-content').removeClass('active');
            $('html').removeClass('overflow-hidden');
        },
        showView: function() {
            $('.popup-content').removeClass('active');
            $('.popup-wrapper, .popup-content[data-rel="SearchResultView"]').addClass('active');
            $('html').addClass('overflow-hidden');
        }
    }
}
</script>
