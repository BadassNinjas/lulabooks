<template>
<div class="row">
    <div class="col-sm-12">
        <div style="padding: 0 26px">
            <h1 style="font-weight: 300;" class="text-center">Product Categorization</h1>
        </div>
        <div>
            <br/>
            <h4 style="font-weight: 300;">Click a category to assign your product to it.</h4>
            <category-tree class="dd-selectable" ref="CategoryTreeRoot" :treeData="categoryTreeData" :treeControlsEnabled="categoryTreeControlsEnabled"></category-tree>
        </div>
        <div class="empty-space col-xs-b20"></div>
        <button type="submit" class="btn btn-lg btn-success waves-effect" @click="process.step = 4">Next, upload images!</button>
        <button type="button" class="btn btn-lg btn-default waves-effect" @click="process.step = 2">Back</button>
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
        this.$root.$on('CategoryTreeItemMounted', function(item) {
            if (!that.categoryTreeControlsEnabled) {
                if (that.product.category != null && item.id == that.product.category.id) {
                    $('.dd-handle', '[data-id="' + item.id + '"]').first().addClass('selected');
                }
            }
        });

        this.$root.$on('CategoryTreeItemsReceived', function(data) {
            that.categoryTreeData = data;
        });
    },
    components: {
        CategoryTree
    },
}
</script>
