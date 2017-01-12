<template>
<div>
    <section id="content">
        <div class="container">
            <div class="c-header">
                <h2>Category Manager</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>
                      Category Manager
                      <small>Manage your product categories to best suit your stores requirements.</small>
                    </h2>
                </div>
                <div class="card-body card-padding category-manager">
                    <div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dd" data-id="0">

                                    <category-tree ref="CategoryTreeRoot" :treeData="treeData" :treeControlsEnabled="treeControlsEnabled"></category-tree>

                                </div>
                            </div>
                        </div>
                        <hr/>
                    </div>
                    <div v-if="loading">
                        <preloader :title="loaderTitle" :message="loaderMessage" :size="loaderSize"></preloader>
                        <hr/>
                    </div>
                    <div v-if="treeItemCreateMode">
                        <br/>
                        <form v-on:submit.prevent="createTreeItem()">
                            <div class="form-group">
                                <div class="form-group fg-float">
                                    <div class="fg-line fg-toggled">
                                        <input type="text" class="form-control fg-input" autofocus="" v-model="treeItemCreate.name">
                                        <label class="fg-label">Category Title</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-info" @click="treeItemCreateMode = false;">Cancel</button>
                        </form>
                        <hr/>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-success" @click="treeItemCreateMode = !treeItemCreateMode">Add New Category</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
</template>
<script>
import CategoryTree from './CategoryTree.vue';
import Preloader from '../Shared/Preloader.vue';

export default {
    name: 'category-view',
    mounted() {
        this.initNestable();
        this.fetchCategories();
        this.registerTreeListeners();
    },
    data: function() {
        return {
            loading: true,
            loaderMessage: 'Loading category tree...',
            loaderSize: 'lg',
            treeItemCreateMode: false,
            treeItemCreate: {
                name: '',
                sort_order: 0,
                parent_id: 0
            },
            treeData: [],
            treeControlsEnabled: true,
        }
    },
    methods: {
        registerTreeListeners: function() {
            var that = this;

            that.$root.$on('CategoryTreeItemDeleted', function() {
                that.fetchCategories();
            });
        },
        createTreeItem: function() {
            var that = this;

            that.loading = true;
            that.$http.post('/api/categories/', that.treeItemCreate).then((response) => {
                if (response.data.success) {
                    that.treeItemCreate.name = '';
                    that.treeItemCreateMode = false;

                    that.$router.go(that.$route.path);
                }

                that.loading = false;
            });
        },
        fetchCategories: function() {
            var that = this;

            that.loading = true;
            that.$http.get('/api/categories/').then((response) => {

                if (response.data.success) {
                    that.treeData = response.data.payload;
                }

                that.loading = false;
            });

        },
        initNestable: function() {
            var that = this;

            $('.dd').nestable({
                maxDepth: 20,
                threshold: 10
            });
            $('.dd').nestable().on('change', function() {
                that.$root.$emit('CategoryTreeItemUpdated');
            });
        }
    },
    components: {
        CategoryTree,
        Preloader
    }
}
</script>

<style>
.dd {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    max-width: 100%;
    list-style: none;
    font-size: 13px;
    line-height: 20px;
}

.dd .btn {
    box-shadow: none;
}

.dd-list {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    list-style: none;
}

.dd-list .dd-list {
    padding-left: 30px;
}

.dd-collapsed .dd-list {
    display: none;
}

.dd-item,
.dd-empty,
.dd-placeholder {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    min-height: 20px;
    font-size: 13px;
    line-height: 20px;
}

.dd-selectable .dd-item .selected {
    background: #2196f3;
    color: #fff;
    font-weight: bold;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

.dd-selectable .dd-item .selected:hover {
    color: #fff;
}

.dd-handle {
    display: block;
    height: 30px;
    margin: 5px 0;
    padding: 5px 10px;
    color: #333;
    text-decoration: none;
    border: 1px solid #ccc;
    background: transparent;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    cursor: pointer;
}

.dd-handle:hover {
    color: #2ea8e5;
}

.dd-item>button {
    display: block;
    position: relative;
    cursor: pointer;
    float: left;
    width: 25px;
    height: 20px;
    margin: 5px 0;
    padding: 0;
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
    border: 0;
    background: transparent;
    font-size: 12px;
    line-height: 1;
    text-align: center;
    font-weight: bold;
}

.dd-item>button:before {
    content: '+';
    display: block;
    position: absolute;
    width: 100%;
    text-align: center;
    text-indent: 0;
}

.dd-item>button[data-action="collapse"]:before {
    content: '-';
}

.dd-placeholder,
.dd-empty {
    margin: 5px 0;
    padding: 0;
    min-height: 30px;
    background: #f2fbff;
    border: 1px dashed #b6bcbf;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.dd-empty {
    border: 1px dashed #bbb;
    min-height: 100px;
    background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff), linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel {
    position: absolute;
    pointer-events: none;
    z-index: 9999;
}

.dd-dragel>.dd-item .dd-handle {
    margin-top: 0;
}

.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
    box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
}

.nestable-lists {
    display: block;
    clear: both;
    padding: 30px 0;
    width: 100%;
    border: 0;
    border-top: 2px solid #ddd;
    border-bottom: 2px solid #ddd;
}

@media only screen and (min-width: 700px) {
    .dd {
        float: left;
        width: 100%;
    }
    .dd+.dd {
        margin-left: 2%;
    }
}

.dd-hover>.dd-handle {
    background: #2ea8e5 !important;
}
</style>
