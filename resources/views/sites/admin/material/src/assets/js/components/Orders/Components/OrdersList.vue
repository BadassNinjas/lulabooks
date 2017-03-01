<template>
<div>
    <div class="table-responsive" v-if="state == 'listing'">
        <vuetable ref="vuetable" api-url="/api/orders" table-class="table table-bordered table-striped table-hover" ascending-icon="fa fa-chevron-up" descending-icon="fa fa-chevron-down" pagination-path="payload" data-path="payload.data" :per-page="perPage" :fields="columns"
            :pagination-component="paginationComponent" @vuetable:pagination-data="onPaginationData"></vuetable>
            <div class="vuetable-pagination well">
                <vuetable-pagination-info class="vuetable-pagination-info" ref="paginationInfo" :paginationInfoClass="paginationInfoClass" :pagination-info-template="paginationInfoTemplate"></vuetable-pagination-info>
                <vuetable-pagination class="vuetable-pagination-component" :icons="VueTablePagination.css.icons" :css="VueTablePagination.css" ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
            </div>
    </div>
    <div class="" v-if="state == 'editing'">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div>
                    <h4 style="font-weight: 300;" class="text-center">{{ 'Viewing Order ID #' + order.id }}</h4>
                </div>
                <br/><br/>
                <form v-on:submit.prevent="submitOrderEditForm()">
                    <div class="row" v-if="error">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <p><b>{{ error }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Order Detail</h4>
                            <br/><br/>
                            <table class="table table-responsive table-bordered table-condensed">
                                <tbody>
                                    <tr>
                                        <td>Order Status</td>
                                        <td>
                                            <input type="text" class="input-sm form-control fg-input" v-model="order.status">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Order Payment Status</td>
                                        <td>
                                            <input type="text" class="input-sm form-control fg-input" v-model="order.payment_status">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Order Payment Method</td>
                                        <td>{{ order.payment_method }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/><br/>
                            <br/><br/>
                            <h4>Order Items</h4>
                            <br/><br/>
                            <table class="table table-responsive table-bordered table-condensed">
                                <tbody v-for="item in order.items">
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td>{{ item.name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Price</b></td>
                                        <td>R{{ item.price }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Quantity</b></td>
                                        <td>{{ item.quantity }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <h4 class="pull-right">Total <b>R{{ order.items_total}}</b></h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr/>
                        </div>
                        <div class="col-lg-6">
                            <h4>Customer Detail</h4>
                            <br/><br/>
                            <table class="table table-responsive table-bordered table-condensed">
                                <tbody>
                                    <tr>
                                        <td>Firstname</td>
                                        <td>{{ order.user.billing_detail.firstname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Lastname</td>
                                        <td>{{ order.user.billing_detail.lastname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company</td>
                                        <td>{{ order.user.billing_detail.company }}</td>
                                    </tr>
                                    <tr>
                                        <td>Company VAT #</td>
                                        <td>{{ order.user.billing_detail.company_vat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email Address</td>
                                        <td>{{ order.user.billing_detail.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>{{ order.user.billing_detail.phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                            {{ order.user.billing_detail.country }}
                                            <br/> {{ order.user.billing_detail.region }}
                                            <br/> {{ order.user.billing_detail.city }}
                                            <br/> {{ order.user.billing_detail.street }}
                                            <span v-if="order.user.billing_detail.building"><br/> {{ order.user.billing_detail.building }}</span>
                                            <br/> {{ order.user.billing_detail.postcode }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <hr/>
                            <center>
                                <button type="submit" class="btn btn-lg btn-success waves-effect">Update</button>
                                <button type="button" class="btn btn-lg btn-default waves-effect" @click="state = 'listing'">Cancel</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Vue from 'vue';

Vue.component('custom-order-actions', {
    template: [
        '<div class="pull-right">',
        '<button class="btn btn-xs btn-default btn-link" @click="itemAction(\'edit-item\', rowData)"><i class="fa fa-pencil"></i> Edit</button>',
        '<button class="btn btn-xs btn-default btn-link" @click="itemAction(\'delete-item\', rowData)"><i class="fa fa-trash icon"></i> Delete</button>',
        '</div>'
    ].join(''),
    props: {
        rowData: {
            type: Object,
            required: true
        }
    },
    methods: {
        itemAction: function(action, data) {
            var VueTableComponent = this.$parent;
            var ListingComponent = VueTableComponent.$parent;

            if (action == 'edit-item') {
                ListingComponent.showEditScreen(data);
            } else if (action == 'delete-item') {
                ListingComponent.showConfirmRequestDelete(data.id);
            }
        }
    }
});
export default {
    data: function() {
        return {
            error: false,
            state: 'listing',
            order: {},
            columns: [{
                    name: 'id',
                    title: 'ID',
                },
                {
                    name: 'created_at',
                    title: 'Date',
                },
                {
                    name: 'user.billing_detail.firstname',
                    title: 'Firstname',
                },
                {
                    name: 'user.billing_detail.lastname',
                    title: 'Lastname',
                }, {
                    name: 'user.billing_detail.email',
                    title: 'Email',
                }, {
                    name: 'items_total',
                    title: 'Order Total Price',
                },
                {
                    name: 'payment_method',
                    title: 'Payment Method',
                },
                {
                    name: 'payment_status',
                    title: 'Payment Status',
                },
                 {
                    name: 'status',
                    title: 'Order Status',
                },
                '__component:custom-order-actions',
            ],
            pageData: {},
            perPage: 10,
            paginationInfoTemplate: 'Showing orders <b>{from}</b> to <b>{to}</b> out of a total of <b>{total}</b> orders',
            paginationInfoClass: 'pull-left pagination-info',
            VueTablePagination: {
                css: {
                    wrapperClass: 'pull-right',
                    pageClass: 'btn btn-default',
                    linkClass: '',
                    disabledClass: 'btn-disabled',
                    activeClass: 'btn btn-primary',
                    paginationClass: 'ui bottom attached segment grid',
                    paginationInfoClass: 'left floated left aligned six wide column',
                    icons: {
                        first: 'btn btn-default fa fa-backward',
                        prev: 'btn btn-default fa fa-chevron-left',
                        next: 'btn btn-default fa fa-chevron-right',
                        last: 'btn btn-default fa fa-forward',
                    }
                }
            }
        }
    },
    methods: {
        onPaginationData: function(data) {
            this.pageData = data;
            this.$refs.paginationInfo.setPaginationData(data);
            this.$refs.pagination.setPaginationData(data);
        },
        onChangePage: function(newPageNumber) {
            this.$refs.vuetable.changePage(newPageNumber);
        },
        onStateChange: function(state) {
            this.state = state;
        },
        showEditScreen: function(order) {
            this.order = order;
            this.state = 'editing';
        },
        showConfirmRequestDelete: function(requestId) {
            var that = this;
            swal({
                title: "Are you sure you want to delete this order?",
                text: "This action cannot be undone!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "I'm sure, delete it!",
                closeOnConfirm: true
            }, function() {
                that.$http.delete('/api/orders/' + requestId).then((response) => {
                    if (response.data.success) {
                        that.$refs.vuetable.reload();
                    }
                });
            });
        },
        submitOrderEditForm: function() {
            this.$http.put('/api/orders/' + this.order.id, this.order).then((response) => {
                if (response.data.success) {
                    this.state = 'listing';
                    this.$refs.vuetable.reload();
                } else {
                    this.error = response.data.error.desc;
                    window.scrollTo(0, 0);
                }
            });
        }
    }
}
</script>
<style>
.vuetable-pagination .pagination-info {
    padding-top: 7px;
}

.vuetable-pagination.well {
    padding: 15px;
    padding-bottom: 50px;
    margin: 0;
}

.vuetable-pagination .btn {
    margin: 0;
}
</style>
