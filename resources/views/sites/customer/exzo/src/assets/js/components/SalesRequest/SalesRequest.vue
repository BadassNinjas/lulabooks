<template>
<div class="row">
    <div class="col-lg-8">
        <h4 class="h4 col-xs-b25">Book Sales Request</h4>
        <div v-if="success">
            <div class="empty-space col-xs-b50"></div>
            <h3 class="h3">
                Thank you! We have received your request and will be in contact with you soon!
            </h3>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
        </div>
        <form v-on:submit.prevent="submitRequest()" v-if="!success">
            <div class="row" v-if="error">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        <p>{{ error }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>Do you have old books that you don't need anymore? We buy books! Enter your details and the relevant information of your book and we will get in touch as soon as possible!</p>
                </div>
            </div>
            <div class="empty-space col-xs-b50"></div>
            <div class="row m10">
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="First name" v-model="payload.firstname" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Last name" v-model="payload.lastname" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Email Address" v-model="payload.email" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-6">
                    <input class="simple-input" type="text" value="" placeholder="Contact Number" v-model="payload.phone" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-sm-4">
                    <input class="simple-input" type="text" value="" placeholder="Book Title" v-model="payload.name" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-4">
                    <input class="simple-input" type="text" value="" placeholder="Book ISBN" v-model="payload.isbn" />
                    <div class="empty-space col-xs-b20"></div>
                </div>
                <div class="col-sm-4">
                    <select book-quality>
                         <option disabled="disabled" selected="selected">Book Grade</option>
                         <option value="A-GRADE">A-GRADE</option>
                         <option value="B-GRADE">B-GRADE</option>
                     </select>
                    <div class="empty-space col-xs-b20"></div>
                </div>
            </div>
            <div class="row m10">
                <div class="col-lg-4">
                    <div class="button block size-2 style-3">
                        <span class="button-wrapper">
                     <span class="icon"><img src="/img/customer/exzo/icon-4.png" alt=""></span>
                        <span class="text">Submit</span>
                        </span>
                        <input type="submit" />
                    </div>
                </div>
            </div>
            <div class="empty-space col-xs-b50"></div>
            <div class="empty-space col-xs-b50"></div>
        </form>
    </div>
</div>
</template>
<script>
export default {
    mounted() {
        var that = this;

        $('[book-quality]').SumoSelect({
            search: false,
            floatWidth: 0
        });

        $('[book-quality]').change(function(e) {
            that.payload.grade = e.target.value;
        });
    },
    data: function() {
        return {
            payload: {
                firstname: '',
                lastname: '',
                phone: '',
                email: '',
                grade: '',
                isbn: '',
                name: '',
            },
            success: false,
            error: false,
            result: false,
        }
    },
    methods: {
        submitRequest: function() {
            this.$http.post('/api/sales/request', this.payload).then((response) => {
                if (response.data.success) {
                    this.result = response.data.payload;
                    this.success = true;
                } else {
                    this.error = response.data.error.desc;
                }
            });
        }
    }
}
</script>
