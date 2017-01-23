<template>
<div>
    <aside id="s-main-menu" class="sidebar">
        <div class="smm-header">
            <i class="zmdi zmdi-long-arrow-left" data-ma-action="sidebar-close"></i>
        </div>
        <ul class="smm-alerts" style="margin-bottom: 150px;"></ul>
        <ul class="main-menu">
            <li>
                <router-link tag="a" to="/category-manager"><i class="zmdi zmdi-view-list"></i> Category Manager</router-link>
            </li>
            <li>
                <router-link tag="a" to="/product-manager"><i class="zmdi zmdi-layers"></i> Product Manager</router-link>
            </li>
            <li>
                <router-link tag="a" to="/order-manager"><i class="zmdi zmdi-shopping-cart"></i> Order Manager</router-link>
            </li>
            <li>
                <router-link tag="a" to="/sale-manager"><i class="zmdi zmdi-star"></i> Sales Requests</router-link>
            </li>
            <!-- <li class="sub-menu">
                <a href="javascript:;" data-ma-action="submenu-toggle"><i class="zmdi zmdi-settings"></i> Settings</a>
                <ul>
                    <li>
                        <router-link tag="a" to="/">Currency</router-link>
                    </li>
                    <li>
                        <router-link tag="a" to="/">Something Else</router-link>
                    </li>
                </ul>
            </li> -->
        </ul>
    </aside>
</div>
</template>
