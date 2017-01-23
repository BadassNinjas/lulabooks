<template>
<div>
    <div class="table-responsive" v-if="state == 'listing'">
        <vuetable ref="vuetable" api-url="/api/sales/request" table-class="table table-bordered table-striped table-hover" ascending-icon="fa fa-chevron-up" descending-icon="fa fa-chevron-down" pagination-path="payload" data-path="payload.data" :per-page="perPage"
            :fields="columns" :pagination-component="paginationComponent" @vuetable:pagination-data="onPaginationData"></vuetable>
            <div class="vuetable-pagination well">
                <vuetable-pagination-info class="vuetable-pagination-info" ref="paginationInfo" :paginationInfoClass="paginationInfoClass" :pagination-info-template="paginationInfoTemplate"></vuetable-pagination-info>
                <vuetable-pagination class="vuetable-pagination-component" :icons="VueTablePagination.css.icons" :css="VueTablePagination.css" ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
            </div>
    </div>
    <div class="" v-if="state == 'editing'">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div>
                    <h4 style="font-weight: 300;" class="text-center">{{ 'Edit Request ID #' + salesRequest.id }}</h4>
                </div>
                <br/><br/>
                <form v-on:submit.prevent="submitSalesRequestEditForm()">
                    <div class="row" v-if="error">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <p><b>{{ error }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Customer Detail</h4>
                            <hr/>
                            <br/><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.firstname != null && salesRequest.firstname.length }">
                                    <input type="text" class="input-lg form-control fg-input" disabled v-model="salesRequest.firstname">
                                    <label class="fg-label">Customer Firstname</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.lastname != null && salesRequest.lastname.length }">
                                    <input type="text" class="input-lg form-control fg-input" disabled v-model="salesRequest.lastname">
                                    <label class="fg-label">Customer Lastname</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.email != null && salesRequest.email.length }">
                                    <input type="text" class="input-lg form-control fg-input" disabled v-model="salesRequest.email">
                                    <label class="fg-label">Customer Email Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.phone != null && salesRequest.phone.length }">
                                    <input type="text" class="input-lg form-control fg-input" disabled v-model="salesRequest.phone">
                                    <label class="fg-label">Customer Phone Number</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <br/><br/>
                            <br/><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Book Detail</h4>
                            <hr/>
                            <br/><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.isbn != null && salesRequest.isbn.length }">
                                    <input type="text" class="input-lg form-control fg-input" v-model="salesRequest.isbn">
                                    <label class="fg-label">Book ISBN</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.name != null && salesRequest.name.length }">
                                    <input type="text" class="input-lg form-control fg-input" v-model="salesRequest.name">
                                    <label class="fg-label">Book Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <div class="select">
                                        <select class="form-control" v-model="salesRequest.grade">
                                                  <option :selected="salesRequest.grade == 'A-GRADE'" :value="'A-GRADE'">A-GRADE</option>
                                                  <option :selected="salesRequest.grade == 'B-GRADE'" :value="'B-GRADE'">B-GRADE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <br/><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.price != null && salesRequest.price.length }">
                                    <input type="text" class="input-lg form-control fg-input" v-model="salesRequest.price">
                                    <label class="fg-label">Book Price / Quote</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group input-group fg-float">
                                <span class="input-group-addon"></span>
                                <div class="fg-line" :class="{ 'fg-toggled': salesRequest.status != null && salesRequest.status.length }">
                                    <input type="text" class="input-lg form-control fg-input" v-model="salesRequest.status">
                                    <label class="fg-label">Sale Status</label>
                                </div>
                            </div>
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

Vue.component('custom-request-actions', {
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
            salesRequest: {},
            columns: [{
                    name: 'firstname',
                    label: 'Firstname',
                }, {
                    name: 'lastname',
                    label: 'Firstname',
                }, {
                    name: 'isbn',
                    label: 'Book ISBN',
                }, {
                    name: 'name',
                    label: 'Book Title',
                }, {
                    name: 'grade',
                    label: 'Grade',
                },
                '__component:custom-request-actions',
            ],
            pageData: {},
            perPage: 10,
            paginationInfoTemplate: 'Showing sales requests <b>{from}</b> to <b>{to}</b> out of a total of <b>{total}</b> requests',
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
        showEditScreen: function(salesRequest) {
            this.salesRequest = salesRequest;
            this.state = 'editing';
        },
        showConfirmRequestDelete: function(requestId) {
            var that = this;
            swal({
                title: "Are you sure you want to delete this sales request?",
                text: "This action cannot be undone!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "I'm sure, delete it!",
                closeOnConfirm: true
            }, function() {
                that.$http.delete('/api/sales/request' + requestId).then((response) => {
                    if (response.data.success) {
                        that.$refs.vuetable.reload();
                    }
                });
            });
        },
        submitSalesRequestEditForm: function() {
            this.$http.put('/api/sales/request/' + this.salesRequest.id, this.salesRequest).then((response) => {
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
