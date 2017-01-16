<template>
<div class="" tabindex="-1" role="dialog" aria-hidden="true">
    <div>
        <div>
            <div v-if="process.step == 1">
                <div>
                    <h1 style="font-weight: 300;" class="text-center">{{ process.creatingProduct ? 'Add a New Product' : 'Modify Product Properties' }}</h1>
                </div>
                <form v-on:submit.prevent="submitForm()">
                    <div>
                        <div class="form-group input-group fg-float">
                            <span class="input-group-addon"></span>
                            <div class="fg-line" :class="{ 'fg-toggled': product.name.length }">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.name">
                                <label class="fg-label">What is the name of your product?</label>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group input-group fg-float">
                            <span class="input-group-addon"></span>
                            <div class="fg-line" :class="{ 'fg-toggled': product.caption.length }">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.caption">
                                <label class="fg-label">Think of a great caption to market this product!</label>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group input-group fg-float">
                            <span class="input-group-addon">R</span>
                            <div class="fg-line" :class="{ 'fg-toggled': product.price.length }">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                                <label class="fg-label">How much do you want to sell this item for?</label>
                            </div>
                            <span class="input-group-addon last">ZAR</span>
                        </div>
                        <br/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-lg btn-success waves-effect">{{ process.creatingProduct ? 'Create Product' : 'Modify Product' }}</button>
                        <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <div v-if="process.step == 2">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Your basic product has been {{ process.creatingProduct ? 'created' : 'modified' }}!</h1>
                </div>
                <div>
                    <h3 style="font-weight: 300;">A few things you may want to do in order to make your product more appealing to your customer</h3>
                    <br/>
                    <ul>
                        <li>Assign your product to an organised category</li>
                        <li>Add some content like videos, descriptors, and marketing related information</li>
                        <li>Upload some images and select a primary display image</li>
                    </ul>
                    <br/>
                    <h4 style="font-weight: 300;">Click the green button to {{ process.creatingProduct ? 'start adding your ' : 'modify existing ' }} information or the other to exit.</h4>
                </div>
                <div>
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(3)">Let's Do It!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                </div>
            </div>
            <div v-if="process.step == 3">
                <div class="modal-header" style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Product Categorization</h1>
                </div>
                <div class="modal-body">
                    <br/>
                    <h4 style="font-weight: 300;">Click a category to assign your product to it.</h4>
                    <category-tree class="dd-selectable" ref="CategoryTreeRoot" :treeData="categoryTreeData" :treeControlsEnabled="categoryTreeControlsEnabled"></category-tree>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(4)">Next, upload images!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                </div>
            </div>
            <div v-if="process.step == 4">
                <div class="modal-header" style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Images</h1>
                </div>
                <div class="modal-body" v-if="product.id">
                    <div v-if="product.images.length">
                        <h3 style="font-weight: 300;">Existing Images</h3>
                        <br/>
                        <div class="row">
                            <div class="col-lg-3" v-for="image in product.images">
                                <div class="media" style="padding: 9px;">
                                    <div class="pull-left">
                                        <a :href="'https://' + image.hostname + image.path" target="_blank">
                                            <img :src="'https://' + image.hostname + image.path" width="72" height="72" />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <button class="btn btn-default btn-link" type="button"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/><br/>
                    </div>
                    <div>
                        <h3 style="font-weight: 300;">Upload Images</h3>
                        <dropzone ref="productImages" id="productImages" :acceptedFileTypes="dropzoneOptions.acceptedFileTypes" :showRemoveLink="dropzoneOptions.showRemoveLink" :useFontAwesome="dropzoneOptions.useFontAwesome" :maxFileSizeInMB="dropzoneOptions.maxFileSizeInMB"
                            :url="dropzoneOptions.url" v-on:vdropzone-success="onImageuploadSuccess">
                            </dropzone>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(5)">Let's add some additional info!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                </div>
            </div>
            <div v-if="process.step == 5">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Additional Information</h1>
                </div>
                <div>
                    <VueEditor ref="VueEditor" :content="product.detail"></VueEditor>
                </div>
                <div>
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(6)">Finish!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                </div>
            </div>
            <div v-if="process.step == 6">
                <div class="modal-header" style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">All done! Woo hoo!</h1>
                </div>
                <div class="modal-body">
                    <h3 style="font-weight: 300;">If you completed all sections provided, your product is ready and will show up on your store page immediately! You can edit your product at any time by navigating to your product listing page and clicking the 'edit' button on the product you wish to modify.</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-success waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>
</template>
<script>
import CategoryTree from '../CategoryManager/CategoryTree.vue';
import Dropzone from 'vue2-dropzone';
import VueEditor from './ProductDetailEditor.vue';

export default {
    props: [
      'withId'
    ],
    mounted() {
        var that = this;

        this.$root.$on('CategoryTreeItemMounted', function(item) {
            if (!that.categoryTreeControlsEnabled) {
                if (that.product.category != null && item.id == that.product.category.id) {
                    $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');
                }
            }
        });

        this.$root.$on('CategoryTreeItemClicked', function(item) {
            if (!that.categoryTreeControlsEnabled) {
                $('.dd-handle', '[data-id]').removeClass('selected');
                $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');

                that.updateProductCategory(item.id);
            }
        });
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
                price: ''
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
        },
        submitForm: function() {
            this.product.id ? this.updateProduct() : this.createProduct();
        },
        onImageuploadSuccess: function(file) {

        },
        createProduct: function() {
            this.$http.post('/api/products', this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.dropzoneOptions.url = '/api/products/' + this.product.id + '/image';
                    this.process.step = 2;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        updateProduct: function() {
            this.$http.put('/api/products/' + this.product.id, this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.dropzoneOptions.url = '/api/products/' + this.product.id + '/image';
                    this.process.step = 2;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        updateProductDetail: function() {
            this.product.detail = this.$refs.VueEditor.getContent();
            this.$http.put('/api/products/' + this.product.id, this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.step = 6;

                    if (this.$refs.VueEditor !== undefined) {
                        this.$refs.VueEditor.setContent(this.product.detail);
                    }
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        fetchProduct: function(id) {

            this.$http.get('/api/products/' + id).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;

                    if (this.$refs.VueEditor !== undefined) {
                        this.$refs.VueEditor.setContent(this.product.detail);
                    }
                }
            });
        },
        fetchCategories: function() {
            this.$http.get('/api/categories').then((response) => {
                if (response.data.success) {
                    this.categoryTreeData = response.data.payload;
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
            if(stepNumber == 6)
            {
              this.updateProductDetail();
              this.instance(null);
            }
        }
    },
    components: {
        Dropzone,
        CategoryTree,
        VueEditor
    },
}
</script>
