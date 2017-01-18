<template>
<div>
    <section id="content">
        <div class="container">
            <div class="c-header">
                <h2>Product Management</h2>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h2>Product Management <small>What would you like to do with your products?</small></h2>
                </div>

                <div class="card-body card-padding">
                    <div class="row" v-if="ViewState == 'dash'">
                        <div class="col-lg-12">
                            <div class="col-lg-4">
                                <div class="manager-option btn btn-primary waves-effect" @click="addProduct()">
                                    <h3>Add a New Product</h3>
                                    <i class="zmdi zmdi-layers zmdi-hc-5x"></i>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="manager-option btn btn-primary waves-effect" @click="ViewState = 'list'">
                                    <h3>View All Products</h3>
                                    <i class="zmdi zmdi-format-list-bulleted zmdi-hc-5x"></i>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="manager-option btn btn-primary waves-effect" @click="ViewState = 'featured'">
                                    <h3>Set Featured Products</h3>
                                    <i class="zmdi zmdi-star-circle zmdi-hc-5x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="ViewState == 'product'">
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <a href="javascript:;" class="btn btn-primary pull-right manager-btn" @click="ViewState = 'dash'">Previous Menu</a>
                            </div>
                        </div>
                        <process :withId="withId" :ViewState="ViewState"></process>
                    </div>
                    <div class="row" v-if="ViewState == 'list'">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:;" class="btn btn-default btn-link pull-left manager-btn" @click="refreshProductList()"><i class="fa fa-refresh"></i> Refresh</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="javascript:;" class="btn btn-success pull-right manager-btn" @click="ViewState = 'product'">Add a New Product</a>
                                <a href="javascript:;" class="btn btn-primary pull-right manager-btn" @click="ViewState = 'dash'">Previous Menu</a>
                            </div>
                        </div>
                        <list></list>
                    </div>
                    <div class="row" v-if="ViewState == 'featured'">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                                <a href="javascript:;" class="btn btn-primary pull-right manager-btn" @click="ViewState = 'dash'">Previous Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<style>
.manager-option {
    border: 1px solid rgba(100, 153, 206, 0.31);
    border-radius: 7px;
    text-align: center;
    cursor: pointer;
    color: rgba(100, 153, 206, 0.85);
    width: 100%;
}

.manager-btn {
    margin: 0 5px;
}

.manager-option:hover {
    border-color: #659ace;
    color: #659ace;
}

.manager-option h3 {
    font-weight: 300;
    color: inherit;
}

.manager-option i {
    color: inherit;
}
</style>

<script>
import List from './Components/List/List.vue';
import Process from './Components/Process/Process.vue';
export default {
    data: function() {
        return {
            ViewState: 'dash',
            withId: null,
        }
    },
    methods: {
        addProduct: function() {
            this.withId = null;
            this.ViewState = 'product';
        }
    },
    components: {
        List,
        Process
    }
}
</script>
