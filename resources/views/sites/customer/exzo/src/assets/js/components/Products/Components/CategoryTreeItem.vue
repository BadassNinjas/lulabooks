<template>
<li>
    <a href="#" @click="emitClickedCategory(item)">{{ item.name }}</a>
    <div class="toggle" v-if="item.children.length"></div>
    <ul v-if="item.children.length">
        <slot name="childTreeComponent"></slot>
    </ul>
</li>
</template>
<script>
export default {
    props: [
        'item'
    ],
    methods: {
        emitClickedCategory: function(category) {
            this.$root.$emit('ClickedCategory', category);
        }
    }
}
</script>
