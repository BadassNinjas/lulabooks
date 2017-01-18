<template>
<div class="" tabindex="-1" role="dialog" aria-hidden="true">
    <div>
        <div>
            <basic v-if="process.step == 1" :process="process" :product="product"></basic>
            <basic-success v-if="process.step == 2" :process="process"></basic-success>
            <category v-if="process.step == 3" :process="process" :categoryTreeData="categoryTreeData" :categoryTreeControlsEnabled="categoryTreeControlsEnabled"></category>
            <images v-if="process.step == 4" :process="process" :product="product" :dropzoneOptions="dropzoneOptions"></images>

            <div v-if="process.step == 5">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">Additional Information</h1>
                </div>
                <div>
                  <summer-note ref='SummerNote'></summer-note>
                </div>
                <div>
                    <button type="submit" class="btn btn-lg btn-success waves-effect" @click="setProcessStep(6)">Finish!</button>
                    <button type="button" class="btn btn-lg btn-default waves-effect" @click="setProcessStep(5)">Back</button>
                </div>
            </div>
            <div v-if="process.step == 6">
                <div style="padding: 0 26px">
                    <h1 style="font-weight: 300;" class="text-center">All done! Woo hoo!</h1>
                </div>
                <div>
                    <h3 style="font-weight: 300;">If you completed all sections provided, your product is ready and will show up on your store page immediately! You can edit your product at any time by navigating to your product listing page and clicking the 'edit' button on the product you wish to modify.</h3>
                </div>
                <div>
                    <button type="button" class="btn btn-lg btn-success waves-effect">Close</button>
                </div>
            </div>
            <br/>
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
import Images from './Steps/Images.vue';

export default {
    props: [
      'withId'
    ],
    mounted() {
        var that = this;
        // this.$root.$on('CategoryTreeItemMounted', function(item) {
        //     if (!that.categoryTreeControlsEnabled) {
        //         if (that.product.category != null && item.id == that.product.category.id) {
        //             $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');
        //         }
        //     }
        // });

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

        updateProductDetail: function() {
            this.product.detail = this.$refs.SummerNote.getContent();
            this.$http.put('/api/products/' + this.product.id, this.product).then((response) => {
                if (response.data.success) {
                    this.product = response.data.payload;
                    this.process.step = 6;
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
                    // this.$root.$emit('CategoryTreeItemsReceived', response.data.payload);
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
            if(stepNumber == 5)
            {
            }
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
        SummerNote,
        Basic,
        BasicSuccess,
        Category,
        Images
    },
}
</script>
