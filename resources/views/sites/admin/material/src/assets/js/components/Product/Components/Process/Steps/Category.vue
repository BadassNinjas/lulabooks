<template>
<div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div style="padding: 0 26px">
            <h1 style="font-weight: 300;" class="text-center">Product Categorization</h1>
        </div>
        <div>
            <br/>
            <h4 style="font-weight: 300;">Click a category to assign your product to it.</h4>
            <category-tree class="dd-selectable" ref="CategoryTreeRoot" :treeData="categoryTreeData" :treeControlsEnabled="categoryTreeControlsEnabled"></category-tree>
        </div>
        <br/><br/>
        <center>
            <button type="submit" class="btn btn-lg btn-success waves-effect" @click="process.step = 4">Next, upload images!</button>
        </center>
    </div>
</div>
</template>
<script>
import CategoryTree from '../../../../CategoryManager/CategoryTree.vue';

export default {
    props: [
        'process',
        'product',
        'categoryTreeData',
        'categoryTreeControlsEnabled'
    ],
    mounted() {
        var that = this;

        $('.dd-handle', '[data-id]').removeClass('selected');

        if (that.product.category != null) {
            $('.dd-handle', '[data-id="' + that.product.category.id + '"]').first().addClass('selected');
        }

        this.$root.$on('CategoryTreeItemsReceived', function(data) {
            that.categoryTreeData = data;
        });
    },
    components: {
        CategoryTree
    },
}
</script>
