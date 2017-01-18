<template>
<ol class="dd-list">
    <tree-item :data-id="child.id" :data-parent-id="child.parent_id" :data="child" :controlsEnabled="treeControlsEnabled" v-for="child in treeData">
        <tree-view v-if="child.children" slot="childTreeComponent" :treeControlsEnabled="treeControlsEnabled" :treeData="child.children"></tree-view>
    </tree-item>
</ol>
</template>
<script>
import TreeItem from './CategoryTreeItem.vue';

export default {
    name: 'tree-view',
    props: [
        'treeData'
    ],
    components: {
        TreeItem,
    },
    methods: {

    }
}
</script>
