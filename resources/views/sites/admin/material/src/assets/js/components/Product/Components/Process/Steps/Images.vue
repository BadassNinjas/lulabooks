<template>
<div class="row">
    <div class="col-sm-12">
        <div style="padding: 0 26px">
            <h1 style="font-weight: 300;" class="text-center">Images</h1>
        </div>
        <div v-if="product.id">
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
        <div class="empty-space col-xs-b50"></div>
        <button type="submit" class="btn btn-lg btn-success waves-effect" @click="process.step = 5">Let's add some additional info!</button>
        <button type="button" class="btn btn-lg btn-default waves-effect" @click="process.step = 3">Back</button>
    </div>
</div>
</template>
<script>
import Dropzone from 'vue2-dropzone';

export default {
    props: [
        'process',
        'product',
        'dropzoneOptions'
    ],

    mounted() {

    },
    methods: {

    },
    components: {
        Dropzone
    }

}
</script>
