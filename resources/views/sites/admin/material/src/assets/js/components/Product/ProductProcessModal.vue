<template>
<div product-modal class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div v-if="process.step == 1">
                <div class="modal-header">
                    <h1 style="font-weight: 300;" class="text-center">{{ process.creatingProduct ? 'Add a New Product' : 'Modify Product Properties' }}</h1>
                </div>
                <form v-on:submit.prevent="createProduct()">
                    <div class="modal-body">
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
                            <div class="fg-line">
                                <input type="text" class="input-lg form-control fg-input" v-model="product.price">
                                <label class="fg-label">How much do you want to sell this item for?</label>
                            </div>
                            <span class="input-group-addon last">ZAR</span>
                        </div>
                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-success waves-effect">Create Product</button>
                        <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <div v-if="process.step == 2">
                <div v-if="process.creatingProduct">
                    <div class="modal-header" style="padding: 0 26px">
                        <h1 style="font-weight: 300;" class="text-center">Your basic product has been created!</h1>
                    </div>
                    <div class="modal-body">
                        <h3 style="font-weight: 300;">A few things you may want to do in order to make your product more appealing to your customer</h3>
                        <br/>
                        <ul>
                            <li>Assign your product to an organised category</li>
                            <li>Add some content like videos, descriptors, and marketing related information</li>
                            <li>Upload some images and select a primary display image</li>
                        </ul>
                        <br/>
                        <h4 style="font-weight: 300;">Click the green button to start adding your additional information or the other to exit.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(3)">Let's Do It!</button>
                        <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                    </div>
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

                    <div class="alert alert-success" v-if="process.category">
                        <p>Set {{ product.name }}'s category to {{ product.category.name }}'</p>
                    </div>
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
                    <dropzone ref="productImages" id="productImages" :acceptedFileTypes="dropzoneOptions.acceptedFileTypes" :showRemoveLink="dropzoneOptions.showRemoveLink" :useFontAwesome="dropzoneOptions.useFontAwesome" :maxFileSizeInMB="dropzoneOptions.maxFileSizeInMB"
                        :url="dropzoneOptions.url" v-on:vdropzone-success="dropzoneOptions.showSuccess">
                        </dropzone>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(5)">Let's add some additional info!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
                </div>
            </div>
            <div v-if="process.step == 5">
                <div class="modal-header" style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Additional Information</h1>
                </div>
                <div class="modal-body" v-if="product.id">
                    <Vueditor ref="VueEditor" style="height: 400px;"></Vueditor>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="updateProduct()" data-dismiss="modal">Finish!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" data-dismiss="modal">Nah, Close</button>
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
import Vue from 'vue';
import Vuex from 'vuex';
import Vueditor from 'vueditor';

let config = {
    toolbar: [
        'removeFormat', 'undo', '|', 'elements', 'fontName', 'fontSize', 'foreColor', 'backColor', 'divider',
        'bold', 'italic', 'underline', 'strikeThrough', 'links', 'divider', 'subscript', 'superscript',
        'divider', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 'indent', 'outdent',
        'insertOrderedList', 'insertUnorderedList', '|', 'emoji', 'picture', 'tables', '|', 'switchView'
    ],
    fontName: [{
        val: "arial black"
    }, {
        val: "times new roman"
    }, {
        val: "Courier New"
    }],
    fontSize: ['12px', '14px', '16px', '18px', '0.8rem', '1.0rem', '1.2rem', '1.5rem', '2.0rem'],
    emoji: ["1f600", "1f601", "1f602", "1f923", "1f603"],
    lang: 'en',
    mode: 'default',
    iframePath: '',
    fileuploadUrl: ''
};

Vue.use(Vuex);
Vue.use(Vueditor, config);

export default {
    mounted() {
        var that = this;
        this.fetchCategories();
        this.$root.$on('CategoryTreeItemClicked', function(item) {
            if (!that.categoryTreeControlsEnabled) {
                $('.dd-handle', '[data-id]').removeClass('selected');
                $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');
                that.updateProductCategory(item.id);
            }
        });
    },
    data: function() {
        return {
            product: {},
            process: {},
            dropzoneOptions: {
                showRemoveLink: true,
                acceptedFileTypes: 'image/*',
                useFontAwesome: true,
                maxFileSizeInMB: 2,
                url: ''
            },
            categoryTreeData: [],
            categoryTreeControlsEnabled: false,
        }
    },
    methods: {
        instance: function(withId) {
            this.reset(withId);
            $('[product-modal]').modal('show');
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
                maxFileSizeInMB: 2,
                url: ''
            };
        },
        createProduct: function() {
            this.$http.post('/api/products', this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.step = 2;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        updateProduct: function() {
            this.product.detail = this.$refs.VueEditor.getContent();
            console.log(this.detail);
            this.$http.put('/api/products/' + this.product.id, this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.step = 100;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        fetchCategories: function() {
            var that = this;
            that.$http.get('/api/categories/').then((response) => {
                if (response.data.success) {
                    that.categoryTreeData = response.data.payload;
                }
            });
        },
        updateProductCategory: function(categoryId) {
            var that = this;
            var payload = this.product;
            payload.category_id = categoryId;
            this.$http.put('/api/products/' + this.product.id, payload).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.dropzoneOptions.url = '/api/products/' + this.product.id + '/image';
                    this.process.category = response.data.payload.category;
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        },
        setProcessStep: function(stepNumber) {
            this.process.step = stepNumber;
        }
    },
    components: {
        Dropzone,
        CategoryTree
    },
}
</script>

<style>
.modal-footer a {
    padding: 15px;
}
</style>
>
