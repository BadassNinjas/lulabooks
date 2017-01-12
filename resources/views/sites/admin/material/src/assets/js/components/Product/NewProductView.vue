<template>
<div>
    <section id="content">
        <div class="container">
            <div class="c-header">
                <h2>New Product</h2>
            </div>
            <div class="card">


                <!-- <form v-on:submit.prevent="createProduct">
                    <div class="card-header">
                        <h2>
                          New Product
                          <small>Add a new product and all its information to your store.</small>
                        </h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="form-group fg-float">
                            <div class="fg-line" :class="{ 'fg-toggled': product.name.length }">
                                <input type="text" class="input-sm form-control fg-input" v-model="product.name">
                                <label class="fg-label">Name</label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group fg-float">
                        <div class="fg-line" :class="{ 'fg-toggled': product.caption.length }">
                            <input type="text" class="input-sm form-control fg-input" v-model="product.caption">
                            <label class="fg-label">Caption</label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group fg-float">
                        <div class="fg-line" :class="{ 'fg-toggled': product.price !== null }">
                            <input type="text" class="input-sm form-control fg-input" v-model="product.price">
                            <label class="fg-label">Price</label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <label class="fg-label">Detail</label>
                        </div>
                        <br/><br/>
                        <div class="html-editor"></div>
                    </div>
                    <br/>
                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <label class="fg-label">Product Images</label>
                        </div>
                        <br/><br/>
                        <dropzone ref="productImages" id="productImages" :acceptedFileTypes="acceptedFileTypes" :showRemoveLink="showRemoveLink" :useFontAwesome="useFontAwesome" :maxFileSizeInMB="maxFileSizeInMB" url="https://httpbin.org/post" v-on:vdropzone-success="showSuccess">
                        </dropzone>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-success">Create Product</button>
                </div>
                </form> -->
            </div>
        </div>
    </section>
</div>
</template>

<script>
import Dropzone from 'vue2-dropzone';
export default {
    mounted() {
        this.initPlugins();
    },
    data: function() {
        return {
            product: {
                name: '',
                caption: '',
                detail: '',
                price: '0.00'
            },
            showRemoveLink: true,
            acceptedFileTypes: 'image/*',
            useFontAwesome: true,
            maxFileSizeInMB: 2
        }
    },
    components: {
        Dropzone
    },
    methods: {
        showSuccess: function(file) {
        },
        initPlugins: function() {
            $('.html-editor').summernote({
                height: 250
            });
        },
        createProduct: function() {
            this.product.detail = $('.html-editor').code();
            this.$http.post('/api/products', this.product).then((response) => {
                if (response.data.success) {
                } else {
                    alert(response.data.payload.error.desc);
                }
            });
        }
    }
}
</script>
script>
