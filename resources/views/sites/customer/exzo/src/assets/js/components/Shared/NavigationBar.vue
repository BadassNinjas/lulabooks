<template>
<div>
    <div class="header-bottom">
        <div class="content-margins">
            <div class="row">
                <div class="col-xs-5 col-sm-5">
                    <router-link tag="a" to="/" id="logo"><img src="img/lulalogo.png" alt="" /></router-link>
                </div>
                <div class="col-xs-7 col-sm-7 text-right">
                    <div class="nav-wrapper">
                        <div class="nav-close-layer"></div>
                        <nav>
                            <ul>
                                <li :class="{ 'active': $route.name == 'Home'}">
                                    <router-link tag="a" to="/">Home</router-link>
                                </li>
                                <li :class="{ 'active': $route.name == 'Contact'}">
                                    <router-link tag="a" to="/contact">Contact</router-link>
                                </li>
                                <li :class="{ 'active': $route.name == 'Checkout'}">
                                    <router-link tag="a" to="/checkout">Checkout</router-link>
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
                    <div class="header-bottom-icon visible-rd"><i class="fa fa-heart-o" aria-hidden="true"></i></div>
                    <div class="header-bottom-icon visible-rd">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <span class="cart-label">5</span>
                    </div>
                </div>
            </div>
            <div class="header-search-wrapper">
                <div class="header-search-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                                <form>
                                    <div class="search-submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <input type="submit" />
                                    </div>
                                    <input class="simple-input style-1" type="text" value="" placeholder="Enter keyword" />
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
