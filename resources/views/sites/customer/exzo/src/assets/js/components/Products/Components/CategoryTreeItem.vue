<template>
<li>
    <a href="javascript:;" @click="emitClickedCategory">{{ item.name }}</a>
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
        emitClickedCategory: function(e) {
            window.scrollTo(0,0);
            this.$root.$emit('ClickedCategory', this.item);

            $(e.target).parent().find('ul').first().slideToggle();
        }
    }
}
</script>
