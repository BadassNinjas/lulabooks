<template>
<div>
    <div id="loader-wrapper"></div>
    <div id="content-block">

        <page-header></page-header>

        <div class="grey-background">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>

        <page-slider></page-slider>

        <page-featured-products></page-featured-products>

    </div>

    <page-footer></page-footer>

    <div class="popup-wrapper">
        <div class="bg-layer"></div>

        <page-login></page-login>

        <page-register></page-register>

        <page-product-view></page-product-view>

    </div>
</div>
</template>

<script>
import PageHeader from './Shared/PageHeader.vue';
import PageSlider from './Shared/PageSlider.vue';
import PageFeaturedProducts from './Shared/PageFeaturedProducts.vue';
import PageFooter from './Shared/PageFooter.vue';
import PageLogin from './Shared/PageLogin.vue';
import PageRegister from './Shared/PageRegister.vue';
import PageProductView from './Shared/PageProductView.vue';

export default {
    mounted() {

    },
    methods: {

    },
    components: {
        PageHeader,
        PageSlider,
        PageFeaturedProducts,
        PageFooter,
        PageLogin,
        PageRegister,
        PageProductView,

    },
    data: function() {
        return {

        }
    },
    watch: {

    }
}
</script>
