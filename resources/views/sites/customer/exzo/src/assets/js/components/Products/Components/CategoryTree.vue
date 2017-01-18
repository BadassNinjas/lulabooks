<template>
<div>
    <category-tree-item :item="item" v-for="item in categories">
        <tree-view v-if="item.children.length" slot="childTreeComponent" :categories="item.children"></tree-view>
    </category-tree-item>
</div>
</template>
<script>
import CategoryTreeItem from './CategoryTreeItem.vue';

export default {
    name: 'tree-view',
    props: [
        'categories'
    ],
    components: {
        CategoryTreeItem,
    }
}
</script>
