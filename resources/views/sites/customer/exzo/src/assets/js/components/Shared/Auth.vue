<script>
export default {
    created() {
        var that = this;

        this.$root.$on('GetAuth', function() {
            that.$root.$emit('GotAuth', that.getAuth());
        });

        this.checkAuthentication();
    },
    data: function() {
        return {
            auth: {
                authed: false,
                persona: {}
            }
        }
    },
    methods: {
        getAuth: function() {
            return this.auth;
        },
        checkAuthentication: function() {
            this.$http.get('/api/auth/').then((response) => {
                if (response.data.success) {

                } else {

                }
            });
        }
    },
    render: function() {

    }
}
</script>
