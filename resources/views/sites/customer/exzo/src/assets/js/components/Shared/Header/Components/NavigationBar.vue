<template>
<div>
    <div class="header-bottom">
        <div class="content-margins">
            <div class="row">
                <div class="col-xs-2 col-sm-2">
                    <router-link tag="a" to="/" id="logo"><img src="/img/lulalogo.png" alt="" /></router-link>
                </div>
                <div class="col-xs-10 col-sm-10 text-right">
                    <div class="nav-wrapper">
                        <div class="nav-close-layer"></div>
                        <nav>
                            <ul>
                                <li :class="{ 'active': $route.name == 'Home'}">
                                    <router-link tag="a" to="/">Home</router-link>
                                </li>
                                <li v-for="category in categories" :class="{ 'active': $route.params.category_id == category.id}">
                                    <router-link tag="a" :to="'/products/' + category.id">{{ category.name }}</router-link>
                                </li>
                                <li :class="{ 'active': $route.name == 'FAQ'}">
                                    <router-link tag="a" to="/faq">How It Works</router-link>
                                </li>
                                <!-- <li :class="{ 'active': $route.name == 'Terms'}">
                                    <router-link tag="a" to="/terms">Terms and Conditions</router-link>
                                </li> -->
                                <li :class="{ 'active': $route.name == 'About'}">
                                    <router-link tag="a" to="/about">About Us</router-link>
                                </li>
                                <li :class="{ 'active': $route.name == 'Contact'}">
                                    <router-link tag="a" to="/contact">Contact</router-link>
                                </li>
                            </ul>
                            <div class="navigation-title">
                                Navigation
                                <div class="hamburger-icon active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                        </nav>
                    </div>
                    <div class="header-bottom-icon toggle-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <router-link tag="div" to="/checkout" class="header-bottom-icon visible-rd">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <span class="cart-label" v-if="ShoppingCart">{{ ShoppingCart.items.length }}</span>
                    </router-link>
                </div>
            </div>
            <div class="header-search-wrapper">
                <div class="header-search-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                                <form v-on:submit.prevent="submitSearch">
                                    <div class="search-submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <input type="submit" />
                                    </div>
                                    <input class="simple-input style-1" type="text" value="" placeholder="Enter keyword" v-model="searchTerm" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="button-close"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    created() {
        var that = this;

        this.$root.$on('CategoryDataReceived', function(categories) {
            that.categories = categories;
        });

        this.$root.$emit('CategoryDataRequested');
    },
    props: [
        'ShoppingCart',
    ],
    data: function() {
        return {
            categories: [],
            searchTerm: '',
        }
    },
    methods: {
        submitSearch: function() {
            this.$http.get('/api/products/search/' + this.searchTerm).then((response) => {
                this.$root.$emit('SearchResultsReturned', response.data.payload);
            });
        }
    }
}
</script>
