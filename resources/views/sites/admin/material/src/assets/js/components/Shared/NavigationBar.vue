<template>
<div>
    <header id="header" class="media">
        <div class="pull-left h-logo">
            <router-link tag="a" to="/" class="hidden-xs">
                LulaBooks <small>Store Administration</small>
            </router-link>

            <div class="menu-collapse" data-ma-action="sidebar-open" data-ma-target="main-menu">
                <div class="mc-wrap">
                    <div class="mcw-line top palette-White bg"></div>
                    <div class="mcw-line center palette-White bg"></div>
                    <div class="mcw-line bottom palette-White bg"></div>
                </div>
            </div>
        </div>

        <ul class="pull-right h-menu ">
            <li class="hm-search-trigger ">
                <a href="javascript:;" data-ma-action="search-open ">
                    <i class="hm-icon zmdi zmdi-search "></i>
                </a>
            </li>

            <li class="dropdown hidden-xs hidden-sm h-apps ">
                <li class="dropdown hidden-xs ">
                    <a data-toggle="dropdown" href="javascript:;"><i class="hm-icon zmdi zmdi-more-vert "></i></a>
                    <ul class="dropdown-menu dm-icon pull-right ">
                        <li>
                            <a href="profile-about.html "><i class="zmdi zmdi-account "></i> View Profile</a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="zmdi zmdi-input-antenna "></i> Privacy Settings</a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="zmdi zmdi-settings "></i> Settings</a>
                        </li>
                        <li @click="$parent.doLogout(); ">
                            <a href="javascript:; "><i class="zmdi zmdi-time-restore "></i> Logout</a>
                        </li>
                    </ul>
                </li>
        </ul>

        <!-- <div class="media-body h-search ">
            <form class="p-relative ">
                <input type="text " class="hs-input " placeholder="Search for people, files & reports ">
                <i class="zmdi zmdi-search hs-reset " data-ma-action="search-clear "></i>
            </form>
        </div> -->

    </header>
</div>
</template>
