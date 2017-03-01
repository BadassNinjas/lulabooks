<template>
<div>
    <basic v-if="process.step == 1" :process="process" :product="product" :ViewState="ViewState"></basic>
    <basic-success v-if="process.step == 2" :process="process"></basic-success>
    <category v-if="process.step == 3" :process="process" :product="product" :categoryTreeData="categoryTreeData" :categoryTreeControlsEnabled="categoryTreeControlsEnabled"></category>
    <div v-if="process.step == 4">
        <div class="row" v-if="product">
            <div class="col-sm-12">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Images</h1>
                </div>
                 <div v-if="product.images">
                    <h3 style="font-weight: 300;">Existing Images</h3>
                    <br/>
                    <div class="row">
                        <div class="col-lg-3" v-for="image in product.images">
                            <div class="media" style="padding: 9px;">
                                <div class="pull-left">
                                    <a :href="image.path" target="_blank">
                                        <img :src="image.path" width="72" height="72" />
                                    </a>
                                </div>
                                <div class="media-body">
                                    <button class="btn btn-default btn-link" type="button" v-on:click="showConfirmImageDelete(image.id)"><i class="fa fa-trash"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                </div>
                <h3 style="font-weight: 300;">Upload Images</h3>
                <dropzone ref="productImages" id="productImages" :acceptedFileTypes="dropzoneOptions.acceptedFileTypes" :showRemoveLink="dropzoneOptions.showRemoveLink" :useFontAwesome="dropzoneOptions.useFontAwesome" :maxFileSizeInMB="dropzoneOptions.maxFileSizeInMB"
                    :url="dropzoneOptions.url" v-on:vdropzone-success="onImageuploadSuccess">
                    </dropzone>

                    <br/><br/>
                    <center>
                        <button type="submit" class="btn btn-lg btn-success waves-effect" @click="process.step = 5">Let's add some additional info!</button>
                    </center>
            </div>
        </div>
    </div>
    <div v-if="process.step == 5">
        <div class="row">
            <div class="col-sm-12">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Additional Information</h1>
                </div>
                <summer-note ref='SummerNote' :content="product.detail"></summer-note>
                <center>
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(6)">Nearly done!</button>
                </center>
            </div>
        </div>
    </div>
    <div v-if="process.step == 6">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">All done! Woo hoo!</h1>
                </div>
                <h3 style="font-weight: 300;">If you completed all sections provided, your product is ready and will show up on your store page immediately! You can edit your product at any time by navigating to your product listing page and clicking the 'edit' button on the product you wish to modify.</h3>
                <br/>
                <center>
                    <button type="button" class="btn btn-lg btn-success waves-effect" @click="endProcess()">Close</button>
                </center>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import CategoryTree from '../../../CategoryManager/CategoryTree.vue';
import Dropzone from 'vue2-dropzone';
import SummerNote from '../DetailEditor.vue';
import Basic from './Steps/Basic.vue';
import BasicSuccess from './Steps/BasicSuccess.vue';
import Category from './Steps/Category.vue';

export default {
    props: [
        'withId',
        'Viewstate'
    ],
    created() {
        var that = this;

        this.$root.$on('CreateProductReceived', function(data) {
            that.product = data;
            that.dropzoneOptions.url = '/api/products/' + that.product.id + '/image';
            that.process.step = 2;
        });
        this.$root.$on('UpdateProductReceived', function(data) {
            that.product = data;
            that.dropzoneOptions.url = '/api/products/' + that.product.id + '/image';
            that.process.step = 2;
        });

        this.$root.$on('CategoryTreeItemClicked', function(item) {
            if (!that.categoryTreeControlsEnabled) {
                $('.dd-handle', '[data-id]').removeClass('selected');
                $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');

                that.updateProductCategory(item.id);
            }
        });

        this.$root.$on('CategoryTreeItemsRequested', function() {
            that.fetchCategories();
        });
    },
    destroyed() {
        this.$root.$off('CategoryTreeItemClicked');
        this.$root.$off('UpdateProductReceived');
        this.$root.$off('CreateProductReceived');
        this.$root.$off('CategoryTreeItemsRequested');
    },
    mounted() {
        this.instance(this.withId);
    },
    data: function() {
        return {
            product: {},
            process: {},
            dropzoneOptions: {},
            categoryTreeData: [],
            categoryTreeControlsEnabled: false,
        }
    },
    methods: {
        instance: function(withId) {
            this.reset(withId);
            this.fetchProduct(withId);
            this.fetchCategories();
        },
        reset: function(withId) {
            this.product = {
                id: withId,
                name: '',
                caption: '',
                detail: '',
                price: '',
            };
            this.process = {
                step: 1,
                creatingProduct: !withId ? true : false,
            };
            this.dropzoneOptions = {
                showRemoveLink: true,
                acceptedFileTypes: 'image/*',
                useFontAwesome: true,
                maxFileSizeInMB: 4,
                url: ''
            };
            $('.dd-handle', '[data-id]').removeClass('selected');
        },
        onImageuploadSuccess: function(file) {},
        updateProductDetail: function() {
            this.product.detail = this.$refs.SummerNote.getContent();
            this.$http.put('/api/products/' + this.product.id, this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;

                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        fetchProduct: function(id) {
            this.$http.get('/api/products/' + id).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                }
            });
        },
        fetchCategories: function() {
            var that = this;
            this.$http.get('/api/categories').then((response) => {
                if (response.data.success) {
                    that.categoryTreeData = response.data.payload;
                }
            });
        },
        updateProductCategory: function(categoryId) {
            var payload = this.product;

            payload.category_id = categoryId;

            this.$http.put('/api/products/' + this.product.id, payload).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.category = response.data.payload.category;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        setProcessStep: function(stepNumber) {
            this.process.step = stepNumber;

            if (stepNumber == 6) {
                this.updateProductDetail();
                this.process.step = 6;
            }
        },
        showConfirmImageDelete: function(imageId) {
            var that = this;
            swal({
                title: "Are you sure you want to delete this image?",
                text: "This action cannot be undone!",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "I'm sure, delete it!",
                closeOnConfirm: true
            }, function() {
                that.$http.delete('/api/products/deleteImage/' + imageId).then((response) => {
                    if (response.data.success) {
                        
                    }
                });
            });
        },
        endProcess: function() {
            this.instance(null);
            this.$parent.ViewState = 'dash';
        }

    },
    components: {
        Dropzone,
        CategoryTree,
        SummerNote,
        Basic,
        BasicSuccess,
        Category
    },
}
</script>
