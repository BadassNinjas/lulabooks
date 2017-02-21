<script>
export default {
    created() {
        var that = this;

        this.cache = window.localStorage;
        this.store = window.sessionStorage;

        this.$root.$on('GetCached', function(key) {
            that.$root.$emit('GotCached', that.getCached(key));
        });

        this.$root.$on('GetStored', function(key) {
            that.$root.$emit('GotStored', that.getStored(key));
        });
    },
    data: function() {
        return {
            cache: null,
            store: null,
        }
    },
    methods: {
        getCached: function(key) {
            return this.cache.getItem(key);
        },
        getStored: function(key) {
            return this.store.getItem(key);
        }
    },
    render: function() {}
}
</script>
