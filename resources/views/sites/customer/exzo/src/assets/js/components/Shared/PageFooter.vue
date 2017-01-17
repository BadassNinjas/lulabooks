<template>
<div>
    <footer>
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                        <img src="img/lulalogowhite.png" alt="" style="height:60px;width:150px;"/>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="simple-article size-2 light fulltransparent">We are all about buying and selling University text books. We have a full range of new, second hand and e-books and are focussed on providing convenience and cutting costs for students.</div>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="footer-contact"><i class="fa fa-mobile" aria-hidden="true"></i> contact us: <a href="tel:+27799479680">+27 79 947 9680</a></div>
                        <div class="footer-contact"><i class="fa fa-envelope-o" aria-hidden="true"></i> email: <a href="mailto:lucky@lulabooks.mobi">lucky@lulabooks.mobi</a></div>
                        <div class="footer-contact"><i class="fa fa-map-marker" aria-hidden="true"></i> address: <a href="#">Robert Sobukwe Road, UWC, Bellville</a></div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-b30 col-md-b0">
                    </div>
                    <div class="clear visible-sm"></div>
                    <div class="col-sm-6 col-md-3 col-xs-b30 col-sm-b0">
                        <h6 class="h6 light">popular tags</h6>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="tags clearfix">
                            <a class="tag">stationery</a>
                            <a class="tag">textbooks</a>
                        </div>
                        <br>
                        <br>
                        <br>
                        <h6 class="h6 light">quick links</h6>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="footer-column-links">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="/">home</a>
                                    <a href="/contact">contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3"></div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-lg-8 col-xs-text-center col-lg-text-left col-xs-b20 col-lg-b0">
                        <div class="copyright">&copy; {{ YearDate }} All rights reserved. Development by <a href="https://rollout.co.za/" target="_blank">Rollout</a></div>
                        <div class="follow">
                            <!-- <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="entry" href="#"><i class="fa fa-twitter"></i></a>
                            <a class="entry" href="#"><i class="fa fa-linkedin"></i></a>
                            <a class="entry" href="#"><i class="fa fa-google-plus"></i></a>
                            <a class="entry" href="#"><i class="fa fa-pinterest-p"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-text-center col-lg-text-right">
                        <div class="footer-payment-icons">
                            <a class="entry"><img src="img/customer/exzo/thumbnail-6.jpg" alt="" /></a>
                            <a class="entry"><img src="img/customer/exzo/thumbnail-8.jpg" alt="" /></a>
                            <a class="entry"><img src="img/customer/exzo/thumbnail-9.jpg" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
</template>

<script>
export default {
    mounted() {
        var that = this;
        var d = new Date();
        this.YearDate = d.getFullYear();
    },
    data() {
        return {
            YearDate: ''
        }
    },
    methods: {
    }
}
</script>
