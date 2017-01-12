<template>
<li class="dd-item" :data-id="data.id" :data-parent-id="data.parent_id">
    <div class="dd-handle waves-effect" @click="$root.$emit('CategoryTreeItemClicked', data)">
        <i class="fa fa-hand-paper-o"></i>
        <span> {{ data.name }} ({{ data.product_count }})</span>
        <a class="dd-nodrag btn btn-xs btn-default btn-link pull-right" v-if="controlsEnabled && !editMode" @click="editMode = !editMode;"><i class="fa fa-i-cursor"></i> Edit</a>
    </div>
    <div v-if="controlsEnabled && editMode">
        <br/>
        <form v-on:submit.prevent="updateModel()">
            <div class="form-group">
                <div class="form-group fg-float">
                    <div class="fg-line fg-toggled">
                        <input type="text" class="form-control fg-input" v-model="data.name" autofocus="">
                        <label class="fg-label">New Title</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-info" @click="editMode = false;">Cancel</button>
            <button type="button" class="btn btn-danger pull-right" @click="confirmModelDelete">Delete</button>
        </form>
        <hr/>
    </div>
    <slot v-if="hasChildren" name="childTreeComponent"></slot>
</li>
</template>
<script>
import Vue from 'vue';

export default {
    mounted() {
        this.registerTreeListener();
    },
    directives: {
        focus: focus
    },
    props: ['data', 'controlsEnabled'],
    computed: {
        hasChildren: function() {
            return this.data.children && this.data.children.length;
        }
    },
    data: function() {
        return {
            editMode: false,
        }
    },
    methods: {
        confirmModelDelete: function() {
            var that = this;
            swal({
                title: "Are you sure you want to delete this category?",
                text: "All child categories and any attached products will be moved to the nearest parent category. Please ensure any attached categories and/or products are moved before issuing this delete.",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "I'm sure, delete it!",
                closeOnConfirm: true
            }, function() {
                that.$http.delete('/api/categories/' + that.data.id).then((response) => {
                    if (response.data.success) {
                        that.editMode = false;
                        that.$root.$emit('CategoryTreeItemDeleted');
                    }
                });
            });
        },
        updateModel: function() {
            this.$http.post('/api/categories/' + this.data.id, this.data).then((response) => {
                if (response.data.success) {
                    this.editMode = false;
                    this.$root.$emit('CategoryTreeUpdated', this);
                }
            });
        },
        registerTreeListener: function() {
            var that = this;

            that.$root.$on('CategoryTreeItemUpdated', function() {

                var thisElement = $('[data-id="' + that.data.id + '"]');
                var parentElement = thisElement.parent().parent();
                var parentId = that.data.parent_id;
                var sortOrder = that.data.sort_order;

                if (parentElement.length > 0) {
                    parentId = $(parentElement).attr('data-id');
                }

                // Check if position changed and set new sort order
                $('[data-id]', parentElement).each(function(i, o) {
                    if ($(o).attr('data-id') == that.data.id) {
                        sortOrder = i;
                    }
                });

                if (parentId != that.data.parent_id || sortOrder != that.data.sort_order) {
                    thisElement.attr('data-parent-id', parentId);
                    that.data.parent_id = parentId;
                    that.data.sort_order = sortOrder;
                    that.updateModel();
                }
            });
        }
    }
}
</script>
